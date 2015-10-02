<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Toastr;
use Auth;

class PagesController extends Controller
{
    public function about()
    {
        if (!Auth::user()){
            Toastr::info('Please login.');
        }
        return view('about');
    }

    public function contact()
    {
        return view('tickets.create');
    }

    public function home()
    {
        return view('home');
    }

    public function queries()
    {
//        Toastr::info('Recent Database Queries');
//        $queries = DB::getQueryLog();
//        return view('backend.queries.index')->with('queries', $queries);
    }

    public function welcome()
    {
        return view('welcome');
    }

}
