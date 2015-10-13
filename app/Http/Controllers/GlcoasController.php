<?php

namespace App\Http\Controllers;

use App\Glcoa;
use App\Gltrn;
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

class GlcoasController extends Controller
{

    /**
     * Are the ledger chart of accounts opening totals in debit/credit balance?
     * Return the balance.
     *
     * @return mixed
     */
    public function checkLedger()
    {
        $results = DB::select(DB::raw("SELECT SUM(init) AS balance FROM glcoas"));
        $balance = $results[0]->balance;
        if ($balance != 0) {
            Toastr::warning('Your ledger is out of balance by $' . number_format($balance, 2), 'Validation');
        }
        return $balance;
    }

    /**
     * Is the journal in debit/credit balance?
     * Return the balance.
     *
     * @return mixed
     */
    public function checkJournal()
    {
        $results = DB::select(DB::raw("SELECT SUM(amount) AS balance FROM gltrns"));
        $balance = $results[0]->balance;
        if ($balance != 0) {
            Toastr::warning('Your journal is out of balance by $' . number_format($balance, 2), 'Validation');
        }
        return $balance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balance = SELF::checkJournal();
        $balance = SELF::checkLedger();

        $glcoas = Glcoa::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.glcoa.index')->with(['glcoas' => $glcoas, 'balance' => $balance]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounting.glcoa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GlcoaEditFormRequest $request)
    {
        $glcoa = new Glcoa(array(
            'acct' => $request->get('acct'),
            'title' => $request->get('title'),
            'init' => $request->get('init'),
        ));
        $glcoa->save();
        Toastr::success('Account has been created.');
        return redirect('/glcoas'); //->with('status', 'Account has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $balance = SELF::checkJournal();
        $balance = SELF::checkLedger();

        $glcoa = Glcoa::whereId($id)->firstOrFail();
        $gltrns = DB::table('gltrns')->where('acct', $glcoa->acct)->get();
        return view('accounting.glcoa.show')->with(['glcoa' => $glcoa, 'gltrns' => $gltrns]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $glcoa = Glcoa::whereId($id)->firstOrFail();
        return view('accounting.glcoa.edit')->with('glcoa', $glcoa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, GlcoaEditFormRequest $request)
    {
        $glcoa = Glcoa::whereId($id)->firstOrFail();
        $glcoa->acct = $request->get('acct');
        $glcoa->title = $request->get('title');
        $glcoa->init = $request->get('init');
        $glcoa->save();
        return redirect(action('GlcoasController@index', $glcoa->id))->with('status', 'The account has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Glcoa::find($id)->delete();
        $glcoas = Glcoa::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.glcoa.index')->with('glcoas', $glcoas);
    }

    /**
     * Detailed Statement
     *
     * @return $this
     */
    public function detail()
    {
        $balance = SELF::checkJournal();
        $balance = SELF::checkLedger();

        $glcoas = Glcoa::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.glcoa.detail')->with('glcoas', $glcoas);
    }

    public function glcoaExcel()
    {
        $data = DB::select(DB::raw("SELECT * FROM glcoas"));
        $data = json_encode($data);
        SELF::data2excel('Excel', 'Sheet1', json_decode($data, true));
    }

    public function glcoaPdf()
    {
        $users = Glcoa::all();
        $view = view('reports.glcoas')->with('glcoas', $users);
        $contents = $view->render();
        SELF::html2pdf($contents);
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
