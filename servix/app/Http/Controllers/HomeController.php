<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index():View{
        return view('homepage');
    }


    
}
