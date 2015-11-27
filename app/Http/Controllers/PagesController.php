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
        if (!Auth::user()) {
            Toastr::info('Please login.');
        }

        /**
         * Which version of Laravel are you using?
         */
        $laravel = app();
        $version = $laravel::VERSION;

        /**
         * Does gravatar exist?
         */
        if (Auth::user()) {
            if (Gravatar::exists(Auth::user()->email)) {
                Toastr::success('Gravatar exists.');
                $gravatar = Gravatar::get(Auth::user()->email);
                return view('about')->with(['gravatar' => $gravatar, 'version' => $version]);
            } else {
                Toastr::danger('Gravatar does not exist.');
                $gravatar = "";
                return view('about');
            }
        }

        return view('about');
    }

    public function home()
    {
        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }

}
