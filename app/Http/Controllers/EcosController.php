<?php

namespace App\Http\Controllers;

use App\Eco;
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


class EcosController extends Controller
{
    public function index()
    {
        $ecos = Eco::orderBy('eco')->paginate(env('ECO_PAGINATION_MAX'));
        return view('ecos.index')->with('ecos', $ecos);
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $ecos = Eco::where('eco', 'LIKE', '%' . $token . '%')
            ->orWhere('opening', 'LIKE', '%' . $token . '%')
            ->orderBy('eco')
            ->paginate(env('ECO_PAGINATION_MAX'));
        return view('ecos.index')->with('ecos', $ecos);
    }

    public function create()
    {
        return view('ecos.create');
    }

    public function store(Request $request)
    {
        $eco = new Eco(array(
            'eco' => $request->get('eco'),
            'opening' => $request->get('opening'),
            'moves' => $request->get('moves'),
        ));
        $eco->save();
        Toastr::success('ECO created.');
        return redirect('/ecos');
    }

    public function show($id)
    {
        $eco = Eco::whereId($id)->firstOrFail();
        return view('ecos.show')->with('eco', $eco);
    }

    public function edit($id)
    {
        $eco = Eco::whereId($id)->firstOrFail();
        return view('ecos.edit')->with('eco', $eco);
    }

    public function update(Request $request, $id)
    {
        $eco = Eco::whereId($id)->firstOrFail();
        $eco->eco = $request->get('eco');
        $eco->opening = $request->get('opening');
        $eco->moves = $request->get('moves');
        $eco->save();
        Toastr::success('ECO updated.');
        return redirect(action('EcosController@index'));
    }

    public function destroy($id)
    {
        Eco::find($id)->delete();
        $ecos = Eco::orderBy('name')->paginate(env('ECO_PAGINATION_MAX'));
        return view('ecos.index');
    }

    public function excel()
    {
        $table = with(new Eco)->getTable();
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
