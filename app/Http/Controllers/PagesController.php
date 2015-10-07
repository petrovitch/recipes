<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Gravatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Toastr;

class PagesController extends Controller
{
    public function about()
    {
        /**
         * Is user logged-in?
         */
        if (!Auth::user()){
            Toastr::info('Please login.');
        }

        /**
         * Does gravatar exist?
         */
        if (Auth::user()) {
            if (Gravatar::exists(Auth::user()->email)) {
                Toastr::success('Gravatar exists.');
                $gravatar = Gravatar::get(Auth::user()->email);
                return view('about')->with('gravatar', $gravatar);
            } else {
                Toastr::danger('Gravatar does not exist.');
                $gravatar = "";
                return view('about');
            }
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
