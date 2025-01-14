<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PengajuanPending;
use App\Models\Pengajuan;

class HomeController extends Controller
{
    private function resetSession()
    {
        // Reset Session
        session()->forget('edit_id');
        session()->forget('action_id');
        session()->forget('route_id');
    }
    public function index()
    {
        $currentRoute = "home";
        $countPending = PengajuanPending::count();
        $countSuccess = PengajuanPending::count(); //TEMP
        $countReject = PengajuanPending::count(); //TEMP
        $countTotal = PengajuanPending::count(); //TEMP

        $this->resetSession();

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
