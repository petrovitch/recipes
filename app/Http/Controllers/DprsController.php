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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zipcodes = Zipcode::orderBy('zipcode')->paginate(env('ZIPCODE_PAGINATION_MAX'));
        return view('zipcodes.index')->with('zipcodes', $zipcodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zipcodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zipcode = new zipcode(array(
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zipcode = Zipcode::whereId($id)->firstOrFail();
        return view('zipcodes.show')->with('zipcode', $zipcode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zipcode = Zipcode::whereId($id)->firstOrFail();
        return view('zipcodes.edit')->with('zipcode', $zipcode);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        return redirect(action('ZipcodesController@index', $zipcode->$zipcode));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Zipcode::find($id)->delete();
        $zipcodes = Zipcode::orderBy('name')->paginate(env('ZIPCODE_PAGINATION_MAX'));
        return view('zipcodes.index')->with('zipcodes', $zipcodes);
    }

    public function excel()
    {
        $data = DB::select(DB::raw("SELECT * FROM zipcodes"));
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
