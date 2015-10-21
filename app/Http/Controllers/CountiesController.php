<?php

namespace App\Http\Controllers;

use App\County;
use App\Farm;
use App\State;
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
    public function index()
    {
        $counties = County::sortable()->paginate(env('COUNTY_PAGINATION_MAX'));
        return view('counties.index')->with('counties', $counties);
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $counties = County::where('county', 'LIKE', '%' . $token . '%')
            ->orderBy('county')
            ->paginate(env('COUNTY_PAGINATION_MAX'));
        return view('counties.index')->with('counties', $counties);
    }

    public function create()
    {
        return view('counties.create');
    }

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

    public function show($id)
    {
        $county = County::whereId($id)->firstOrFail();
        return view('counties.show')->with('county', $county);
    }

    public function edit($id)
    {
        $county = County::whereId($id)->firstOrFail();
        return view('counties.edit')->with('county', $county);
    }

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

    public function destroy($id)
    {
        County::find($id)->delete();
        $counties = County::orderBy('county')->paginate(env('COUNTY_PAGINATION_MAX'));
        return view('counties.index')->with('counties', $counties);
    }

    public function excel()
    {
        $table = with(new County)->getTable();
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
