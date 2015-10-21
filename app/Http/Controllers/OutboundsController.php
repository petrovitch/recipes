<?php

namespace App\Http\Controllers;

use App\Outbound;
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

class OutboundsController extends Controller
{
    public function index()
    {
        $outbounds = Outbound::orderBy('outbound')->paginate(env('OUTBOUND_PAGINATION_MAX'));
        return view('outbounds.index')->with('outbounds', $outbounds);
    }

    public function create()
    {
        return view('outbounds.create');
    }

    public function store(Request $request)
    {
        $outbound = new Outbound(array(
            'city' => $request->get('city'), //////////////////////////////////
        ));
        $outbound->save();
        Toastr::success('Outbound ticket created.');
        return redirect('/outbounds');
    }

    public function show($id)
    {
        $outbound = Outbound::whereId($id)->firstOrFail();
        return view('outbounds.show')->with('outbound', $outbound);
    }

    public function edit($id)
    {
        $outbound = Outbound::whereId($id)->firstOrFail();
        return view('outbounds.edit')->with('outbound', $outbound);
    }

    public function update(Request $request, $id)
    {
        $outbound = Outbound::whereId($id)->firstOrFail();
        $outbound->city = $request->get('city'); //////////////////////////////////////////
        $outbound->save();
        Toastr::success('Outbound ticket updated.');
        return redirect(action('OutboundsController@index', $outbound->$outbound));
    }

    public function destroy($id)
    {
        Outbound::find($id)->delete();
        $outbounds = Outbound::orderBy('name')->paginate(env('OUTBOUND_PAGINATION_MAX'));
        return view('outbounds.index')->with('outbounds', $outbounds);
    }

    public function excel()
    {
        $table = with(new Outbound)->getTable();
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
