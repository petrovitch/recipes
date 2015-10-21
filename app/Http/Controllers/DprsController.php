<?php

namespace App\Http\Controllers;

use App\Dpr;
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

class DprsController extends Controller
{
    public function index()
    {
        $dprs = Dpr::orderBy('dpr')->paginate(env('DPR_PAGINATION_MAX'));
        return view('dprs.index')->with('dprs', $dprs);
    }

    public function create()
    {
        return view('dprs.create');
    }

    public function store(Request $request)
    {
        $dpr = new Dpr(array(
            'city' => $request->get('city'), /////////////////////
        ));
        $dpr->save();
        Toastr::success('DPR created.');
        return redirect('/dprs');
    }

    public function show($id)
    {
        $dpr = Dpr::whereId($id)->firstOrFail();
        return view('dprs.show')->with('dpr', $dpr);
    }

    public function edit($id)
    {
        $dpr = Dpr::whereId($id)->firstOrFail();
        return view('dprs.edit')->with('dpr', $dpr);
    }

    public function update(Request $request, $id)
    {
        $dpr = Dpr::whereId($id)->firstOrFail();
        $dpr->city = $request->get('city'); ///////////////////////////
        $dpr->save();
        Toastr::success('DPR updated.');
        return redirect(action('DprsController@index', $dpr->$dpr));
    }

    public function destroy($id)
    {
        Dpr::find($id)->delete();
        $dprs = Dpr::orderBy('name')->paginate(env('DPR_PAGINATION_MAX'));
        return view('dprs.index')->with('dprs', $dprs);
    }

    public function excel()
    {
        $table = with(new Dpr)->getTable();
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
