<?php

namespace App\Http\Controllers;

use App\County;
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

class CountiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = County::orderBy('county')->paginate(env('COUNTY_PAGINATION_MAX'));
        return view('counties.index')->with('counties', $counties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('counties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $county = new county(array(
            'state_id' => $request->get('state_id'),
            'county' => $request->get('county'),
            'label' => $request->get('label'),
            'locale' => $request->get('locale'),
        ));
        $county->save();
        Toastr::success('County created.');
        return redirect('/counties');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $county = County::whereId($id)->firstOrFail();
        return view('counties.show')->with('county', $county);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $county = County::whereId($id)->firstOrFail();
        return view('counties.edit')->with('county', $county);
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
        $county = County::whereId($id)->firstOrFail();
        $county->state_id = $request->get('state_id');
        $county->county = $request->get('county');
        $county->label = $request->get('label');
        $county->locale = $request->get('locale');
        $county->save();
        Toastr::success('County updated.');
        return redirect(action('CountiesController@index', $county->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        County::find($id)->delete();
        $counties = County::orderBy('county')->paginate(env('COUNTY_PAGINATION_MAX'));
        return view('counties.index')->with('counties', $counties);
    }

    public function excel()
    {
        $data = DB::select(DB::raw("SELECT * FROM counties"));
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
