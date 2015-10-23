<?php

namespace App\Http\Controllers;

use App\Quote;
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

class QuotesController extends Controller
{
    public function index()
    {
        $quotes = Quote::sortable()->paginate(env('QUOTE_PAGINATION_MAX'));
        return view('quotes.index')->with('quotes', $quotes);
    }

    public function get()
    {
        $quotes = Quote::orderBy('author')->paginate(5000);
        return $quotes;
    }

    public function fix()
    {
        $quotes = Quote::orderBy('author')->get();
        foreach ($quotes as $quote) {
            $quote->quote = trim($quote->quote);
            $quote->author = trim($quote->author);
            $quote->save();
        }
        $quotes = Quote::sortable()->paginate(env('QUOTE_PAGINATION_MAX'));
        return view('quotes.index')->with('quotes', $quotes);
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $quotes = Quote::where('quote', 'LIKE', '%' . $token . '%')
            ->whereOr('author', 'LIKE', '%' . $token . '%')
            ->orderBy('author')
            ->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('quotes.index')->with('quotes', $quotes);
    }

    public function create()
    {
        return view('quotes.create');
    }

    public function store(Request $request)
    {
        $quote = new Quote(array(
            'quote' => $request->get('quote'),
            'author' => $request->get('author'),
        ));
        $quote->save();
        Toastr::success('Quote created.');
        return redirect('/quotes');
    }

    public function show($id)
    {
        $quote = Quote::whereId($id)->firstOrFail();
        return view('quotes.show')->with('quote', $quote);
    }

    public function edit($id)
    {
        $quote = Quote::whereId($id)->firstOrFail();
        return view('quotes.edit')->with('quote', $quote);
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::whereId($id)->firstOrFail();
        $quote->quote = $request->get('quote');
        $quote->author = $request->get('author');
        $quote->save();
        Toastr::success('Quote updated.');
        return redirect(action('QuotesController@index', $quote->id));
    }

    public function destroy($id)
    {
        Quote::find($id)->delete();
        $quotes = Quote::orderBy('name')->paginate(env('QUOTE_PAGINATION_MAX'));
        return view('quotes.index')->with('quotes', $quotes);
    }

    public function excel()
    {
        $table = with(new Quote)->getTable();
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
