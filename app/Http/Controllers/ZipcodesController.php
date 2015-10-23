<?php

namespace App\Http\Controllers;

use App\Zipcode;
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

class ZipcodesController extends Controller
{
    public function index()
    {
        $zipcodes = Zipcode::sortable()->paginate(env('ZIPCODE_PAGINATION_MAX'));
        return view('zipcodes.index')->with('zipcodes', $zipcodes);
    }

    public function get()
    {
        $zipcodes = Zipcode::orderBy('id', 'desc')->paginate(env('ZIPCODE_PAGINATION_MAX'));
        return $zipcodes;
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $zipcodes = Zipcode::where('zipcode', 'LIKE', '%' . $token . '%')
            ->orWhere('city', 'LIKE', '%' . $token . '%')
            ->orWhere('state', 'LIKE', '%' . $token . '%')
            ->orWhere('state_name', 'LIKE', '%' . $token . '%')
            ->orWhere('county', 'LIKE', '%' . $token . '%')
            ->orWhere('country', 'LIKE', '%' . $token . '%')
            ->orderBy('zipcode')
            ->paginate(env('ZIPCODE_PAGINATION_MAX'));
        return view('zipcodes.index')->with('zipcodes', $zipcodes);
    }

    public function create()
    {
        return view('zipcodes.create');
    }

    public function store(Request $request)
    {
        $zipcode = new Zipcode(array(
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'state_name' => $request->get('state_name'),
            'zipcode' => $request->get('zipcode'),
            'county' => $request->get('county'),
            'country' => $request->get('country'),
            'lat' => $request->get('lat'),
            'lon' => $request->get('lon'),
        ));
        $zipcode->save();
        Toastr::success('Zipcode created.');
        return redirect('/zipcodes');
    }

    public function show($id)
    {
        $zipcode = Zipcode::whereId($id)->firstOrFail();
        return view('zipcodes.show')->with('zipcode', $zipcode);
    }

    public function edit($id)
    {
        $zipcode = Zipcode::whereId($id)->firstOrFail();
        return view('zipcodes.edit')->with('zipcode', $zipcode);
    }

    public function update(Request $request, $id)
    {
        $zipcode = Zipcode::whereId($id)->firstOrFail();
        $zipcode->city = $request->get('city');
        $zipcode->state = $request->get('state');
        $zipcode->state_name = $request->get('state_name');
        $zipcode->zipcode = $request->get('zipcode');
        $zipcode->county = $request->get('county');
        $zipcode->country = $request->get('country');
        $zipcode->lon = $request->get('lon');
        $zipcode->lat = $request->get('lat');
        $zipcode->save();
        Toastr::success('Zipcode updated.');
        return redirect(action('ZipcodesController@index'));
    }

    public function destroy($id)
    {
        Zipcode::find($id)->delete();
        $zipcodes = Zipcode::orderBy('name')->paginate(env('ZIPCODE_PAGINATION_MAX'));
        return view('zipcodes.index');
    }
    
    public function excel()
    {
        $table = with(new Zipcode)->getTable();
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
