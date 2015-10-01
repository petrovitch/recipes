<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Toastr;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function about()
    {
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

    public function welcome()
    {
        return view('welcome');
    }
}
