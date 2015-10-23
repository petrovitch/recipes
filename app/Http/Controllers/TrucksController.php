<?php

namespace App\Http\Controllers;

use App\Truck;
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

class TrucksController extends Controller
{
    public function index()
    {
        $trucks = Truck::sortable()->paginate(env('TRUCK_PAGINATION_MAX'));
        return view('trucks.index')->with('trucks', $trucks);
    }

    public function get()
    {
        $trucks = Truck::sortable()->paginate(env('TRUCK_PAGINATION_MAX'));
        return $trucks;
    }

    public function create()
    {
        return view('trucks.create');
    }

    public function store(Request $request)
    {
        $truck = new truck(array(
            'company' => $request->get('company'),
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
        ));
        $truck->save();
        Toastr::success('Truck created.');
        return redirect('/trucks');
    }

    public function show($id)
    {
        $truck = Truck::whereId($id)->firstOrFail();
        return view('trucks.show')->with('truck', $truck);
    }

    public function edit($id)
    {
        $truck = Truck::whereId($id)->firstOrFail();
        return view('trucks.edit')->with('truck', $truck);
    }

    public function update(Request $request, $id)
    {
        $truck = Truck::whereId($id)->firstOrFail();
        $truck->company = $request->get('company');
        $truck->street = $request->get('street');
        $truck->city = $request->get('city');
        $truck->state = $request->get('state');
        $truck->zip = $request->get('zip');
        $truck->save();
        Toastr::success('Truck updated.');
        return redirect(action('TrucksController@index', $truck->$truck));
    }

    public function destroy($id)
    {
        Truck::find($id)->delete();
        $trucks = Truck::orderBy('company')->paginate(env('TRUCK_PAGINATION_MAX'));
        return view('trucks.index')->with('trucks', $trucks);
    }

    public function excel()
    {
        $table = with(new Truck)->getTable();
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
