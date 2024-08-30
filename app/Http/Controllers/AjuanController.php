<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjuanController extends Controller
{
    //
    public function index()
    {
        $currentRoute = "ajuan.daftar";
        return view('pages.ajuan.daftar', ['currentRoute' => $currentRoute]);
    }
    public function tambah()
    {
        $currentRoute = "ajuan.tambah";
        return view('pages.ajuan.tambah', ['currentRoute' => $currentRoute]);
    }
}
