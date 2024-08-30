<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $currentRoute = "home";
        return view('home', ['currentRoute' => $currentRoute]);
    }
}
