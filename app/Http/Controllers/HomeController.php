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
        $suffix = "_edit_id";
        foreach (session()->all() as $key => $value) {
            if (str_ends_with($key, $suffix)) {
                session()->forget($key);
            }
        }
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
