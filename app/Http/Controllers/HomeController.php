<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Weather $weather)

    {
        dd($weather);
        return view('home');
    }
}
