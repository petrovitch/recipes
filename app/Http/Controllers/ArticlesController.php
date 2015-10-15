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
        $articles = Article::orderBy('article')->paginate(env('ARTICLE_PAGINATION_MAX'));
        return view('articles.index')->with('articles', $articles);
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $article = new Article(array(
            'article' => $request->get('article'),
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
        $article->article = $request->get('article');
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
