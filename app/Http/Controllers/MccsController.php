<?php

namespace App\Http\Controllers;

use App\Mcc;
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

class MccsController extends Controller
{
    public function create()
    {
        return view('mccs.create');
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

    public function destroy($id)
    {
        Mcc::find($id)->delete();
        $mccs = Mcc::orderBy('name')->paginate(env('MCC_PAGINATION_MAX'));
        return view('mccs.index')->with('mccs', $mccs);
    }

    public function edit($id)
    {
        $mcc = Mcc::whereId($id)->firstOrFail();
        return view('mccs.edit')->with('mcc', $mcc);
    }

    public function excel()
    {
        $table = with(new Mcc)->getTable();
        $data = DB::select(DB::raw("SELECT * FROM $table"));
        $data = json_encode($data);
        SELF::data2excel('Excel', 'Sheet1', json_decode($data, true));
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

    public function index()
    {
        $fix = true;
        if ($fix) {
            $mccs = Mcc::orderBy('name')->get();
            foreach ($mccs as $mcc) {
                $mcc->name = ucwords(strtolower($mcc->name));
                $mcc->save();
            }
        }
        $mccs = Mcc::orderBy('name')->paginate(env('MCC_PAGINATION_MAX'));
        return view('mccs.index')->with('mccs', $mccs);
    }

    public function rating($id)
    {
        $mcc = Mcc::whereId($id)->firstOrFail();
        $buffer = file_get_contents ( 'http://main.uschess.org/assets/msa_joomla/MbrDtlMain.php?' . $mcc->uscf_id );
        $start = "Regular";
        $stop = "Current";
        $start_position = strpos ( $buffer, $start );
        $stop_position = strpos ( $buffer, $stop ) + strlen ( $stop );
        $length = $stop_position - $start_position;
        $buffer = substr ( $buffer, $start_position, $length );
        if (preg_match ( '/.*?([0-9]+).*?/', $buffer, $match )) {
            $mcc->uscf_rating = $match [1];
            $mcc->save();
        }
        $mccs = Mcc::orderBy('name')->paginate(env('MCC_PAGINATION_MAX'));
        return view('mccs.index')->with('mccs', $mccs);
    }

    public function ratings()
    {
        $mccs = Mcc::orderBy('uscf_rating', 'desc')->get();
        foreach ($mccs as $mcc) {
            $buffer = file_get_contents('http://main.uschess.org/assets/msa_joomla/MbrDtlMain.php?' . $mcc->uscf_id);
            $start = "Regular";
            $stop = "Current";
            $start_position = strpos($buffer, $start);
            $stop_position = strpos($buffer, $stop) + strlen($stop);
            $length = $stop_position - $start_position;
            $buffer = substr($buffer, $start_position, $length);
            if (preg_match('/.*?([0-9]+).*?/', $buffer, $match)) {
                $mcc->uscf_rating = $match [1];
                $mcc->save();
            }
        }
        $mccs = Mcc::orderBy('name')->paginate(env('MCC_PAGINATION_MAX'));
        return view('mccs.index')->with('mccs', $mccs);
    }

    public function search(Request $request)
    {
        $token = $request->get('token');
        $mccs = Mcc::where('name', 'LIKE', '%' . $token . '%')
            ->orderBy('name')
            ->paginate(env('RECIPE_PAGINATION_MAX'));
        return view('mccs.index')->with('mccs', $mccs);
    }

    public function show($id)
    {
        $mcc = Mcc::whereId($id)->firstOrFail();
        return view('mccs.show')->with('mcc', $mcc);
    }

    public function store(Request $request)
    {
        $mcc = new Mcc(array(
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'name' => $request->get('name'),
            'zip' => $request->get('zip'),
            'uscf_id' => $request->get('uscf_id'),
            'uscf_rating' => $request->get('uscf_rating'),
        ));
        $mcc->save();
        Toastr::success('Member created.');
        return redirect('/mccs');
    }

    public function update(Request $request, $id)
    {
        $mcc = Mcc::whereId($id)->firstOrFail();
        $mcc->username = $request->get('username');
        $mcc->password = $request->get('password');
        $mcc->name = $request->get('name');
        $mcc->zip = $request->get('zip');
        $mcc->uscf_id = $request->get('uscf_id');
        $mcc->uscf_rating = $request->get('uscf_rating');
        $mcc->save();
        Toastr::success('Member updated.');
        return redirect(action('MccsController@index', $mcc->id));
    }
}
