<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GlcoaEditFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;
use Toastr;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('gameDate', 'desc')
            ->orderBy('white')
            ->orderBy('black')
            ->paginate(env('ARTICLE_PAGINATION_MAX'));
        return view('articles.index')->with('articles', $articles);
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $articles = Article::where('pgn', 'LIKE', '%' . $token . '%')
            ->orderBy('gameDate', 'desc')
            ->orderBy('white')
            ->orderBy('black')
            ->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('articles.index')->with('articles', $articles);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function import()
    {
        return view('articles.import');
    }

    public function imports(Request $request)
    {
        function strip_slashes($var)
        {
            $var = preg_replace('/\\\r\\\n/', '~~', $var);
            $var = preg_replace('/[\\\]+/', '', $var);
            $var = preg_replace('/~~/', '\\\r\\\n', $var);
            $var = preg_replace('/\'/', '`', $var);
            return $var;
        }

        function parseMoves($pgn)
        {
            /* Remove newline, carriage-return */
            $pgn = preg_replace('/(\\\r|\\\n)/', ' ', $pgn);

            /* Remove Chessbase tags */
            $pgn = preg_replace('/\$[0-9]+/', '', $pgn);

            /* Remove PGN Tags */
            $out = '';
            $level = 0;
            for ($i = 0; $i < strlen($pgn); ++$i) {
                if ($pgn [$i] == '[') {
                    ++$level;
                } elseif ($pgn [$i] == ']') {
                    --$level;
                } elseif ($level == 0) {
                    $out .= $pgn [$i];
                }
            }
            $pgn = $out;

            /* Remove comments */
            $out = '';
            $level = 0;
            for ($i = 0; $i < strlen($pgn); ++$i) {
                if ($pgn [$i] == '{') {
                    ++$level;
                } elseif ($pgn [$i] == '}') {
                    --$level;
                } elseif ($level == 0) {
                    $out .= $pgn [$i];
                }
            }
            $pgn = $out;

            /* Remove variations */
            $out = '';
            $level = 0;
            for ($i = 0; $i < strlen($pgn); ++$i) {
                if ($pgn [$i] == '(') {
                    ++$level;
                } elseif ($pgn [$i] == ')') {
                    --$level;
                } elseif ($level == 0) {
                    $out .= $pgn [$i];
                }
            }

            $moves = preg_replace('/(\\\|\[.*?\]|\s+|<br>|{.*?}|\(.*?\)|[0-9]+\.\.\.|\$[0-9]+)/is', ' ', $out);

            /* Replace multiple white-space with single space */
            $moves = preg_replace("/[\s]+/", ' ', $moves);
            return trim($moves);
        }

        function deldup()
        {
            $last_moves = '';
            $articles = Article::orderBy('moves')->get();
            foreach ($articles as $article) {
                if ($last_moves == $article->moves) {
                    Toastr::warning('Duplicate removed. ' . $last_moves);
                    Article::find($article->id)->delete();
                }
                $last_moves = $article->moves;
            }
        }

        $contents = $request['contents'];
        if (isset($contents)) {
            // Clean-up contents
            $contents = preg_replace('/(\$[0-9]+)/is', ' ', $contents);
            $contents = preg_replace('/([\s]+)/is', ' ', $contents);
            trim($contents);

            // Extract all games from pgn contents
            preg_match_all('/([\[]Event.*?Result.*?[\]].*?[\s\n]?(1\-0|0\-1|1\/2\-1\/2))/is', $contents, $matches, PREG_SET_ORDER);
            for ($i = 0; $i < sizeof($matches); $i++) {
                // PREG_SET_ORDER
                $pgn = $matches[$i][0];

                // Get information from pgn tags, i.e., white, black, whiteElo, blackElo, etc.
                if (preg_match('/Event "(.*?)"/', $pgn, $match)) {
                    $event = $match [1];
                }
                if (preg_match('/Site "(.*?)"/', $pgn, $match)) {
                    $site = $match [1];
                }
                if (preg_match('/[^a-zA-Z]Date "(.*?)"/', $pgn, $match)) {
                    $gameDate = $match [1];
                    if (preg_match('/([0-9]+)/', $gameDate, $match2)) {
                        $year = $match2 [1];
                    }
                }
                if (preg_match('/Round "(.*?)"/', $pgn, $match)) {
                    $gameRound = $match [1];
                }
                if (preg_match('/White "(.*?)"/', $pgn, $match)) {
                    $white = $match [1];
                }
                if (preg_match('/Black "(.*?)"/', $pgn, $match)) {
                    $black = $match [1];
                }
                if (preg_match('/Result "(.*?)"/', $pgn, $match)) {
                    $gameResult = $match [1];
                }
                if (preg_match('/ECO "(.*?)"/', $pgn, $match)) {
                    $eco = $match [1];
                }
                if (preg_match('/WhiteElo "(.*?)"/', $pgn, $match)) {
                    $whiteElo = " (" . $match [1] . ")";
                } else {
                    $whiteElo = "";
                }
                if (preg_match('/BlackElo "(.*?)"/', $pgn, $match)) {
                    $blackElo = " (" . $match [1] . ")";
                } else {
                    $blackElo = "";
                }

                // Compose a title from players information
                $title = $white . $whiteElo . " - " . $black . $blackElo;

                // Begin with complete pgn of game
                $moves = $pgn;
                // Strip comments
                $moves = preg_replace('/(\{.*?\})/', '', $moves);
                // Strip pgn tags
                $moves = preg_replace('/\[.*\]/', '', $moves);
                // Convert multiple white space to a single blank char
                $moves = preg_replace("/\s+/", ' ', $moves);
                // Remove alternative lines and variations
                $moves = parseMoves($moves);
                // Strip single & double quotes
                $moves = strip_slashes($moves);

                // Strip slashes from single and double quotes
                $pgn = strip_slashes($pgn);
                $pgn = trim($pgn);

                // Analysis
                if (preg_match('/[{}]/', $pgn, $match)) {
                    $fritz = $pgn;
                } else {
                    $fritz = $pgn;
                }

                // Get PGN tags
                if (preg_match_all('/(\[.*?\])/', $pgn, $matches2, PREG_SET_ORDER)) {
                    $new_pgn = '';
                    for ($j = 0; $j < sizeof($matches2); $j++) {
                        $new_pgn .= $matches2[$j][1] . "\n";
                    }
                    $new_pgn .= "\n";
                    $new_pgn .= $moves;
                }
                $pgn = $new_pgn;

                // Translate date from Jan 1, 2011 to 2011.01.01
                if (preg_match('/"([a-zA-Z]{3}) ([0-9]+), ([0-9]+)"/', $pgn, $match)) {
                    $date_str = date('Y-m-d', strtotime($match[1]));
                    $pgn = preg_replace('/"([a-zA-Z]{3} [0-9]+, [0-9]+)/', $date_str, $pgn);
                    $gameDate = $date_str;
                }

                // Put game on table
                $article = new Article(array(
                    'black' => $black,
                    'blackElo' => $blackElo,
                    'eco' => $eco,
                    'event' => $event,
                    'fritz' => $fritz,
                    'gameDate' => $gameDate,
                    'gameResult' => $gameResult,
                    'gameRound' => $gameRound,
                    'moves' => $moves,
                    'pgn' => $pgn,
                    'site' => $site,
                    'title' => $title,
                    'white' => $white,
                    'whiteElo' => $whiteElo,
                    'year' => $year,
                ));

                $article->save();
            }
        }
        deldup();
        return redirect('/articles');
    }

    public function store(Request $request)
    {
        $article = new Article(array(
            'pgn' => $request->get('pgn'),
            'fritz' => $request->get('fritz'),
        ));
        $article->save();
        Toastr::success('Article created.');
        return redirect('/articles');
    }

    public function show($id)
    {
        $article = Article::whereId($id)->firstOrFail();
        return view('articles.show')->with('article', $article);
    }

    public function edit($id)
    {
        $article = Article::whereId($id)->firstOrFail();
        return view('articles.edit')->with('article', $article);
    }

    public function update(Request $request, $id)
    {
        $article = Article::whereId($id)->firstOrFail();
        $article->pgn = $request->get('pgn');
        $article->fritz = $request->get('fritz');
        $article->save();
        Toastr::success('Article updated.');
        return redirect(action('ArticlesController@index', $article->id));
    }

    public function destroy($id)
    {
        Article::find($id)->delete();
        $articles = Article::orderBy('name')->paginate(env('ARTICLE_PAGINATION_MAX'));
        return view('articles.index')->with('articles', $articles);
    }

    public function excel()
    {
        $table = with(new Article)->getTable();
        $data = DB::select(DB::raw("SELECT * FROM $table"));
        $data = json_encode($data);
        SELF::data2excel('Excel', 'Sheet1', json_decode($data, true));
    }

    public function data2excel($excel, $sheet, $data)
    {
        $this->excel = $excel;
        $this->sheet = $sheet;
        $this->data = $data;
        Excel::create($this->excel, function ($excel) {
            $excel->sheet('Sheetname', function ($sheet) {
                $sheet->appendRow(array_keys($this->data[0])); // column names
                foreach ($this->data as $field) {
                    $sheet->appendRow($field);
                }
            });
        })->export('xlsx');
    }

    public function html2pdf($html)
    {
        $font_size = 8;
        $pdf = new TCPDF();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetFont('times', '', $font_size, '', 'default', true);
        $pdf->AddPage("L");
        $pdf->writeHTML($html);
        $filename = '/report.pdf';
        $pdf->Output($filename, 'I');
    }
}
