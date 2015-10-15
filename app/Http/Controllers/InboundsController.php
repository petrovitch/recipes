<?php

namespace App\Http\Controllers;

use App\Inbound;
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

class InboundsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inbounds = Inbound::orderBy('ticket')->paginate(env('INBOUND_PAGINATION_MAX'));
        return view('inbounds.index')->with('inbounds', $inbounds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inbounds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inbound = new inbound(array(
            'ticket' => $request->get('ticket'),
            'delivery_date' => $request->get('delivery_date'),
            'delivery_time' => $request->get('delivery_time'),
            'producer' => $request->get('producer'),
            'commodity' => $request->get('commodity'),
            'gross' => $request->get('gross'),
            'tare' => $request->get('tare'),
            'net' => $request->get('net'),
            'driver_on' => $request->get('driver_on'),
            'bushel_weight' => $request->get('bushel_weight'),
            'bushels' => $request->get('bushels'),
            'truck_id' => $request->get('truck_id'),
            'trucking_company' => $request->get('trucking_company'),
            'driver' => $request->get('driver'),
            'trailer_license' => $request->get('trailer_license'),
            'grade' => $request->get('grade'),
            'moisture' => $request->get('moisture'),
            'test_weight' => $request->get('test_weight'),
            'damage' => $request->get('damage'),
            'heat_damage' => $request->get('heat_damage'),
            'fm' => $request->get('fm'),
            'splits' => $request->get('splits'),
            'other' => $request->get('other'),
            'base_price' => $request->get('base_price'),
            'total_disc' => $request->get('total_disc'),
            'net_price' => $request->get('net_price'),
            'reason_for_rejection' => $request->get('reason_for_rejection'),
        ));
        $inbound->save();
        Toastr::success('Inbound created.');
        return redirect('/inbounds');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inbound = Inbound::whereId($id)->firstOrFail();
        return view('inbounds.show')->with('inbound', $inbound);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inbound = Inbound::whereId($id)->firstOrFail();
        return view('inbounds.edit')->with('inbound', $inbound);
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
        $inbound = Inbound::whereId($id)->firstOrFail();
        $inbound->ticket = $request->get('ticket');
        $inbound->delivrery_date = $request->get('delivrery_date');
        $inbound->delivery_time = $request->get('delivery_time');
        $inbound->producer = $request->get('producer');
        $inbound->commodity = $request->get('commodity');
        $inbound->gross = $request->get('gross');
        $inbound->tare = $request->get('tare');
        $inbound->net = $request->get('net');
        $inbound->driver_on = $request->get('driver_on');
        $inbound->bushel_weight = $request->get('bushel_weight');
        $inbound->bushels = $request->get('bushels');
        $inbound->truck_id = $request->get('truck_id');
        $inbound->trucking_company = $request->get('trucking_company');
        $inbound->driver = $request->get('driver');
        $inbound->trailer_license = $request->get('trailer_license');
        $inbound->grade = $request->get('grade');
        $inbound->moisture = $request->get('moisture');
        $inbound->test_weight = $request->get('test_weight');
        $inbound->damage = $request->get('damage');
        $inbound->heat_damage = $request->get('heat_damage');
        $inbound->fm = $request->get('fm');
        $inbound->splits = $request->get('splits');
        $inbound->other = $request->get('other');
        $inbound->base_price = $request->get('base_price');
        $inbound->total_disc = $request->get('total_disc');
        $inbound->net_price = $request->get('net_price');
        $inbound->reason_for_rejection = $request->get('reason_for_rejection');
        $inbound->save();
        Toastr::success('Inbound updated.');
        return redirect(action('InboundsController@index', $inbound->$inbound));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inbound::find($id)->delete();
        $inbounds = Inbound::orderBy('ticket')->paginate(env('INBOUND_PAGINATION_MAX'));
        return view('inbounds.index')->with('inbounds', $inbounds);
    }

    public function excel()
    {
        $table = with(new Inbound)->getTable();
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
