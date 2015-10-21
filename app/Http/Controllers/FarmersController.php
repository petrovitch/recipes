<?php

namespace App\Http\Controllers;

use App\farmer;
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

class FarmersController extends Controller
{
    public function index()
    {
        $farms = farmer::sortable()->paginate(env('FARMER_PAGINATION_MAX'));
        return view('farmers.index')->with('farmers', $farms);
    }

    public function create()
    {
        return view('farmers.create');
    }

    public function store(Request $request)
    {
        $farm = new farmer(array(
            'farmer' => $request->get('farmer'),
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
        ));
        $farm->save();
        Toastr::success('Farmer created.');
        return redirect('/farmers');
    }

    public function show($id)
    {
        $farm = farmer::whereId($id)->firstOrFail();
        return view('farmers.show')->with('farmer', $farm);
    }

    public function edit($id)
    {
        $farm = farmer::whereId($id)->firstOrFail();
        return view('farmers.edit')->with('farmer', $farm);
    }

    public function update(Request $request, $id)
    {
        $farm = farmer::whereId($id)->firstOrFail();
        $farm->farmer = $request->get('farmer');
        $farm->street = $request->get('street');
        $farm->city = $request->get('city');
        $farm->state = $request->get('state');
        $farm->zip = $request->get('zip');
        $farm->save();
        Toastr::success('Farmer updated.');
        return redirect(action('FarmersController@index', $farm->$farm));
    }

    public function destroy($id)
    {
        farmer::find($id)->delete();
        $farms = farmer::orderBy('farmer')->paginate(env('FARMER_PAGINATION_MAX'));
        return view('farmers.index')->with('farmers', $farms);
    }

    public function excel()
    {
        $table = with(new Farmer)->getTable();
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
