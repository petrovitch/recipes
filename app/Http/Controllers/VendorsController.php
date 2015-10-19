<?php

namespace App\Http\Controllers;

use App\Vendor;
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

class VendorsController extends Controller
{
    public function index()
    {
//        $vendors = Vendor::orderBy('vendor')->paginate(env('VENDOR_PAGINATION_MAX'));
        $vendors = Vendor::sortable()->paginate(env('VENDOR_PAGINATION_MAX'));
        return view('vendors.index')->with('vendors', $vendors);
    }

    public function create()
    {
        return view('vendors.create');
    }

    public function store(Request $request)
    {
        $vendor = new vendor(array(
            'vendor' => $request->get('vendor'),
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
        ));
        $vendor->save();
        Toastr::success('Vendor created.');
        return redirect('/vendors');
    }

    public function show($id)
    {
        $vendor = Vendor::whereId($id)->firstOrFail();
        return view('vendors.show')->with('vendor', $vendor);
    }

    public function edit($id)
    {
        $vendor = Vendor::whereId($id)->firstOrFail();
        return view('vendors.edit')->with('vendor', $vendor);
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::whereId($id)->firstOrFail();
        $vendor->vendor = $request->get('vendor');
        $vendor->street = $request->get('street');
        $vendor->city = $request->get('city');
        $vendor->state = $request->get('state');
        $vendor->zip = $request->get('zip');
        $vendor->save();
        Toastr::success('Vendor updated.');
        return redirect(action('VendorsController@index', $vendor->$vendor));
    }

    public function destroy($id)
    {
        Vendor::find($id)->delete();
        $vendors = Vendor::orderBy('vendor')->paginate(env('VENDOR_PAGINATION_MAX'));
        return view('vendors.index')->with('vendors', $vendors);
    }

    public function excel()
    {
        $table = with(new Vendor)->getTable();
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
