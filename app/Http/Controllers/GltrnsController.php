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
    public function index()
    {
        $balance = Gltrn::sum('amount');
        if ($balance != 0){
            Toastr::warning('Your journal is out of balance by $' . number_format($balance,2), 'Validation' );
        }

        $gltrns = Gltrn::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.gltrn.index')->with('gltrns', $gltrns);
    }

    public function create()
    {
        return view('accounting.gltrn.create');
    }

    public function store(GltrnEditFormRequest $request)
    {
        $gltrn = new Gltrn(array(
            'acct' => $request->get('acct'),
            'description' => $request->get('description'),
            'crj' => $request->get('crj'),
            'date' => date('Y-m-d', strtotime($request->get('date'))),
            'document' => $request->get('document'),
            'amount' => $request->get('amount'),
        ));
        $gltrn->save();
        Toastr::success('Transaction has been created.');
        return redirect('/gltrns');
    }

    public function show($id)
    {
        $gltrn = Gltrn::whereId($id)->firstOrFail();
        return view('accounting.gltrn.show')->with('gltrn', $gltrn);
    }

    public function edit($id)
    {
        $glcoas = Glcoa::orderBy('acct')->get();
        $gltrn = Gltrn::whereId($id)->firstOrFail();
        return view('accounting.gltrn.edit')->with(['gltrn' => $gltrn, 'glcoas' => $glcoas]);
    }

    public function update($id, GltrnEditFormRequest $request)
    {
        $gltrn = Gltrn::whereId($id)->firstOrFail();
        $gltrn->acct = $request->get('acct');
        $gltrn->description = $request->get('description');
        $gltrn->crj = $request->get('crj');
        $gltrn->date = date('Y-m-d', strtotime($request->get('date')));
        $gltrn->document = $request->get('document');
        $gltrn->amount = $request->get('amount');
        $gltrn->save();
        return redirect(action('GltrnsController@index', $gltrn->id))->with('status', 'The transaction has been updated!');
    }

    public function destroy($id)
    {
        Gltrn::find($id)->delete();
        $gltrns = Gltrn::orderBy('acct')->paginate(env('PAGINATION_MAX'));
        return view('accounting.gltrn.index')->with('gltrns', $gltrns);
    }

}
