<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AuditTrail;

class AuditTrailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audits = AuditTrail::orderBy('id', 'desc')->paginate(env('PAGINATION_MAX'));
        return view('backend.audits.index')->with('audits', $audits);
    }
}
