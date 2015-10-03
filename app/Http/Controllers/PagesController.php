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
        $lines = file('/Applications/MAMP/logs/mysql_queries.log');
        for ($i = 0; $i < sizeof($lines); $i++)
        {
            if (!preg_match('/FROM/i', $lines[$i]))
            {
                unset($lines[$i]);
            }
        }
        $lines = array_values($lines);
        Toastr::info('All Queries');
//        $queries = DB::getQueryLog();
        return view('backend.queries.index')->with('lines', $lines);
    }

    public function slowQueries()
    {
        $lines = file('/Applications/MAMP/logs/mysql_slow.log');
        for ($i = 0; $i < sizeof($lines); $i++)
        {
            if (!preg_match('/FROM/i', $lines[$i]))
            {
                unset($lines[$i]);
            }
        }
        $lines = array_values($lines);
        Toastr::info('Slow Queries');
//        $queries = DB::getQueryLog();
        return view('backend.queries.index')->with('lines', $lines);
    }

    public function welcome()
    {
        return view('welcome');
    }

}
