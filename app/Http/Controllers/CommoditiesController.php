<?php

namespace App\Http\Controllers;

use App\Commodity;
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

class CommoditiesController extends Controller
{
    public function index()
    {
        $commodities = Commodity::sortable()->paginate(env('COMMODITIES_PAGINATION_MAX'));
        return view('commodities.index')->with('commodities', $commodities);
    }

    public function create()
    {
        return view('commodities.create');
    }

    public function store(Request $request)
    {
        $commodity = new Commodity(array(
            'commodity' => $request->get('commodity'),
            'abbr' => $request->get('abbr'),
            'test_weight' => $request->get('test_weight'),
        ));
        $commodity->save();
        Toastr::success('Commodity created.');
        return redirect('/commodities');
    }

    public function show($id)
    {
        $commodity = Commodity::whereId($id)->firstOrFail();
        return view('commodities.show')->with('commodity', $commodity);
    }

    public function edit($id)
    {
        $commodity = Commodity::whereId($id)->firstOrFail();
        return view('commodities.edit')->with('commodity', $commodity);
    }

    public function update(Request $request, $id)
    {
        $commodity = Commodity::whereId($id)->firstOrFail();
        $commodity->commodity = $request->get('commodity');
        $commodity->abbr = $request->get('abbr');
        $commodity->test_weight = $request->get('test_weight');
        $commodity->save();
        Toastr::success('Commodity updated.');
        return redirect(action('CommoditiesController@index'));
    }

    public function destroy($id)
    {
        Commodity::find($id)->delete();
        $commodities = Commodity::orderBy('commodity')->paginate(env('COMMODITIES_PAGINATION_MAX'));
        return view('commodities.index');
    }

    public function excel()
    {
        $data = DB::select(DB::raw("SELECT * FROM commodities"));
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
