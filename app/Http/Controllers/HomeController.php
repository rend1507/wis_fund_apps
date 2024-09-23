<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PengajuanProses;
use App\Models\Pengajuan;

class HomeController extends Controller
{

    public function index()
    {
        $currentRoute = "home";
        $countPending = PengajuanProses::count();
        $countSuccess = Pengajuan::count();
        $countReject = Pengajuan::count();
        $countTotal = Pengajuan::count();

        return view('home', [
            'currentRoute' => $currentRoute,
            'count' => [
                'pending' => $countPending,
                'success' => $countSuccess,
                'reject' => $countReject,
                'total' => $countTotal,
            ],
        ]);
    }
}
