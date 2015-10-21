<?php

namespace App\Http\Controllers;

use App\Game;
use App\Eco;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GlcoaEditFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;
use Toastr;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::sortable()->paginate(env('GAME_PAGINATION_MAX'));
        return view('games.index')->with('games', $games);
    }

    public function fix()
    {
        $games = Game::orderBy('id', 'desc')->take(100)->get();
        foreach ($games as $game) {
            if (strlen($game->eco) > 3){
                $game->eco = preg_replace('/^([a-zA-Z][0-9][0-9]).*?$/i', "$1", $game->eco);
                $game->save();
            }
            if (!$game->ecoCode) {
                $res = DB::select(DB::raw("SELECT * FROM mcc_ecos WHERE eco LIKE '%$game->eco%' LIMIT 1"));
                $game->ecoCode = $res[0]->id;
                $game->save();
            }
        }

        $games = Game::orderBy('id', 'desc')->paginate(env('GAME_PAGINATION_MAX'));
        return view('games.index')->with('games', $games);
    }

    public function parse()
    {
        $games = Game::get();
        foreach ($games as $game) {
            if (preg_match('/Event "(.*?)"/', $game->pgn, $match)) {
                $game->event = $match [1];
            }
            if (preg_match('/Site "(.*?)"/', $game->pgn, $match)) {
                $game->site = $match [1];
            }
            if (preg_match('/[^a-zA-Z]Date "(.*?)"/', $game->pgn, $match)) {
                $game->gameDate = $match [1];
                if (preg_match('/([0-9]+)/', $game->gameDate, $match2)) {
                    $game->year = $match2 [1];
                }
            }
            if (preg_match('/Round "(.*?)"/', $game->pgn, $match)) {
                $game->gameRound = $match [1];
            }
            if (preg_match('/White "(.*?)"/', $game->pgn, $match)) {
                $game->white = $match [1];
            }
            if (preg_match('/Black "(.*?)"/', $game->pgn, $match)) {
                $game->black = $match [1];
            }
            if (preg_match('/Result "(.*?)"/', $game->pgn, $match)) {
                $game->gameResult = $match [1];
            }
            if (preg_match('/ECO "(.*?)"/', $game->pgn, $match)) {
                $game->eco = $match [1];
            }
            if (preg_match('/WhiteElo "(.*?)"/', $game->pgn, $match)) {
                $game->whiteElo = " (" . $match [1] . ")";
            } else {
                $game->whiteElo = "";
            }
            if (preg_match('/BlackElo "(.*?)"/', $game->pgn, $match)) {
                $game->blackElo = " (" . $match [1] . ")";
            } else {
                $game->blackElo = "";
            }

            // Compose a title from players information
            $game->title = $game->white . $game->whiteElo . " - " . $game->black . $game->blackElo;

            // Begin with complete pgn of game
            $game->moves = $game->pgn;
            // Strip comments
            $game->moves = preg_replace('/(\{.*?\})/', '', $game->moves);
            // Strip pgn tags
            $game->moves = preg_replace('/\[.*\]/', '', $game->moves);
            // Convert multiple white space to a single blank char
            $game->moves = preg_replace("/\s+/", ' ', $game->moves);
            // Remove alternative lines and variations
            $game->moves = self::parseMoves($game->moves);
            // Strip single & double quotes
            $game->moves = self::strip_slashes($game->moves);

            // Find eco code for string opening name and moves
            $res = DB::select(DB::raw("SELECT * FROM mcc_ecos WHERE eco LIKE '%$game->eco%' LIMIT 1"));
            $game->ecoCode = $res[0]->id;

            $game->save();
        }

        $games = Game::sortable()->paginate(env('GAME_PAGINATION_MAX'));
        return view('games.index')->with('games', $games);
    }

    public function html()
    {
        $games = Game::orderBy('id', 'desc')
            ->where('gameDate', '!=', '????-??-??')
            ->paginate(env(100));
        return view('games.html')->with('games', $games);
    }

    public function search_form()
    {
        return view('games.search');
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $player = $request->get('player');
        $color = $request->get('color');
        if (strlen($token) > 0) {
            $games = Game::where('pgn', 'LIKE', '%' . $token . '%')
                ->orderBy('gameDate', 'desc')
                ->orderBy('gameRound', 'desc')
                ->orderBy('white')
                ->orderBy('black')
                ->paginate(env('RECIPE_PAGINATION_MAX'));
        } elseif (strlen($player) > 0) {
            if (strlen($color) > 0) {
                if (strtolower($color) == 'white') {
                    $games = Game::where('white', 'LIKE', '%' . $player . '%')
                        ->orderBy('gameDate', 'desc')
                        ->orderBy('gameRound', 'desc')
                        ->orderBy('white')
                        ->orderBy('black')
                        ->paginate(env('RECIPE_PAGINATION_MAX'));
                } else {
                    $games = Game::where('black', 'LIKE', '%' . $player . '%')
                        ->orderBy('gameDate', 'desc')
                        ->orderBy('gameRound', 'desc')
                        ->orderBy('white')
                        ->orderBy('black')
                        ->paginate(env('RECIPE_PAGINATION_MAX'));
                }
            } else {
                $games = Game::where('pgn', 'LIKE', '%' . $player . '%')
                    ->orderBy('gameDate', 'desc')
                    ->orderBy('gameRound', 'desc')
                    ->orderBy('white')
                    ->orderBy('black')
                    ->paginate(env('RECIPE_PAGINATION_MAX'));
            }
        }
        return view('games.index')->with('games', $games);
    }

    public function imports(Request $request)
    {

        /**
         * Main imports
         */
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
                $moves = $this->parseMoves($moves);
                // Strip single & double quotes
                $moves = $this->strip_slashes($moves);

                // Strip slashes from single and double quotes
                $pgn = $this->strip_slashes($pgn);
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
                $game = new Game(array(
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

                $game->save();
            }
        }
        $this->deldup();
        return redirect('/games');
    }

    public function create()
    {
        return view('games.create');
    }

    public function import()
    {
        return view('games.import');
    }

    public function store(Request $request)
    {
        $game = new Game(array(
            'pgn' => $request->get('pgn'),
            'fritz' => $request->get('fritz'),
        ));
        $game->save();

        $data = array(
            'pgn' => $request->get('pgn'),
            'fritz' => $request->get('fritz'),
        );

        Mail::send('emails.import', $data, function ($message){
            $message->from(env('EMAIL_ADDRESS'), 'Chess Games');
            $message->to('kennthompson@gmail.com')->subject('PGN Imported');
        });

        Toastr::success('Game created.');

        return redirect('/games');
    }

    public function show($id)
    {
        $game = Game::whereId($id)->firstOrFail();
        file_put_contents('json/game.pgn', $game->pgn);
        return view('games.show')->with('game', $game);
    }

    public function edit($id)
    {
        $game = Game::whereId($id)->firstOrFail();
        return view('games.edit')->with('game', $game);
    }

    public function update(Request $request, $id)
    {
        $game = Game::whereId($id)->firstOrFail();
        $game->pgn = $request->get('pgn');
        $game->fritz = $request->get('fritz');
        $game->save();
        Toastr::success('Game updated.');
        return redirect(action('GamesController@index', $game->id));
    }

    public function destroy($id)
    {
        Game::find($id)->delete();
        $games = Game::orderBy('name')->paginate(env('GAME_PAGINATION_MAX'));
        return view('games.index')->with('games', $games);
    }

    public function excel()
    {
        $table = with(new Game)->getTable();
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

    public static function deldup()
    {
        $last_moves = '';
        $games = Game::orderBy('moves')->get();
        foreach ($games as $game) {
            if ($last_moves == $game->moves) {
                Toastr::warning('Duplicate removed. ' . $last_moves);
                Game::find($game->id)->delete();
            }
            $last_moves = $game->moves;
        }
    }

    public static function parseMoves($pgn)
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

    public static function strip_slashes($var)
    {
        $var = preg_replace('/\\\r\\\n/', '~~', $var);
        $var = preg_replace('/[\\\]+/', '', $var);
        $var = preg_replace('/~~/', '\\\r\\\n', $var);
        $var = preg_replace('/\'/', '`', $var);
        return $var;
    }
}
