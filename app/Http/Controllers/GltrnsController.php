<?php

namespace App\Http\Controllers;

use App\Glcoa;
use App\Gltrn;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GltrnEditFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;
use Toastr;

class GltrnsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = DB::select( DB::raw("SELECT SUM(amount) AS balance FROM gltrns") );
        $balance = $results[0]->balance;
        if ($balance != 0){
            Toastr::warning('Your journal is out of balance by $' . number_format($balance,2), 'Validation' );
        }

        $gltrns = Gltrn::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.gltrn.index')->with('gltrns', $gltrns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounting.gltrn.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GltrnEditFormRequest $request)
    {
        $gltrn = new Gltrn(array(
            'acct' => $request->get('acct'),
            'description' => $request->get('description'),
            'crj' => $request->get('crj'),
            'date' => $request->get('date'),
            'document' => $request->get('document'),
            'amount' => $request->get('amount'),
        ));
        $gltrn->save();
        return redirect('/gltrns')->with('status', 'Account has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gltrn = Gltrn::whereId($id)->firstOrFail();
        return view('accounting.gltrn.show')->with('gltrn', $gltrn);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gltrn = Gltrn::whereId($id)->firstOrFail();
        $results = DB::table('glcoas')->where('acct', $gltrn->acct)->get();
        $title = $results[0]->title;
        return view('accounting.gltrn.edit')->with(['gltrn' => $gltrn, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, GltrnEditFormRequest $request)
    {
        $gltrn = Gltrn::whereId($id)->firstOrFail();
        $gltrn->acct = $request->get('acct');
        $gltrn->description = $request->get('description');
        $gltrn->crj = $request->get('crj');
        $gltrn->date = $request->get('date');
        $gltrn->document = $request->get('document');
        $gltrn->amount = $request->get('amount');
        $gltrn->save();
        return redirect(action('GltrnsController@index', $gltrn->id))->with('status', 'The transaction has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gltrn::find($id)->delete();
        $gltrns = Gltrn::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.gltrn.index')->with('gltrns', $gltrns);
    }

}
