<?php

namespace App\Http\Controllers;

use App\Glcoa;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GlcoaEditFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;

class GlcoasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $glcoas = Glcoa::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.glcoa.index')->with('glcoas', $glcoas);
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
        return redirect('/glcoas')->with('status', 'Account has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $glcoa = Glcoa::whereId($id)->firstOrFail();
        return view('accounting.glcoa.show')->with('glcoa', $glcoa);
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

    public function checkInit()
    {
        $results = DB::select( DB::raw("SELECT SUM(init) AS balance FROM glcoas") );
        return view('accounting.glcoa.init')->with('results', $results);
    }
}
