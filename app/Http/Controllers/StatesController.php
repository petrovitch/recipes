<?php

namespace App\Http\Controllers;

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

class StatesController extends Controller
{
    public function index()
    {
//        $states = State::orderBy('state')->paginate(env('STATE_PAGINATION_MAX'));
        $states = State::sortable()->paginate(env('STATE_PAGINATION_MAX'));
        return view('states.index')->with('states', $states);
    }

    public function create()
    {
        return view('states.create');
    }

    public function store(Request $request)
    {
        $state = new state(array(
            'state_abr' => $request->get('state_abr'),
            'state' => $request->get('state'),
        ));
        $state->save();
        Toastr::success('State created.');
        return redirect('/states');
    }

    public function show($id)
    {
        $state = State::whereId($id)->firstOrFail();
        return view('states.show')->with('state', $state);
    }

    public function edit($id)
    {
        $state = State::whereId($id)->firstOrFail();
        return view('states.edit')->with('state', $state);
    }

    public function update(Request $request, $id)
    {
        $state = State::whereId($id)->firstOrFail();
        $state->state_abr = $request->get('state_abr');
        $state->state = $request->get('state');
        $state->save();
        Toastr::success('State updated.');
        return redirect(action('StatesController@index', $state->id));
    }

    public function destroy($id)
    {
        State::find($id)->delete();
        $states = State::orderBy('name')->paginate(env('STATE_PAGINATION_MAX'));
        return view('states.index')->with('states', $states);
    }
    
    public function excel()
    {
        $table = with(new State)->getTable();
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
