<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\PengajuanProses;

class AjuanController extends Controller
{
    //
    public function index()
    {
        $currentRoute = "ajuan.daftar";
        $ajuans = Pengajuan::all();

        return view('pages.ajuan.daftar', ['currentRoute' => $currentRoute, 'ajuans' => $ajuans]);
    }
    public function tambah()
    {
        $currentRoute = "ajuan.tambah";
        return view('pages.ajuan.tambah', ['currentRoute' => $currentRoute]);
    }
    public function tambahAction(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pengajuan' => 'required|string|max:40',
            'deskripsi_pengajuan' => 'nullable|string',
            'jumlah_anggaran_pengajuan' => 'required|integer',
            'detail_anggaran_pengajuan' => 'required|string',
            'sifat_pengajuan' => 'required|in:0,1',
        ]);

        $dataAdd = new PengajuanProses();
        $dataAdd->nama_pengajuan = $validatedData['nama_pengajuan'];
        $dataAdd->deskripsi_pengajuan = $validatedData['deskripsi_pengajuan'];
        $dataAdd->jumlah_anggaran_pengajuan = $validatedData['jumlah_anggaran_pengajuan'];
        $dataAdd->detail_anggaran_pengajuan = $validatedData['detail_anggaran_pengajuan'];
        $dataAdd->sifat_pengajuan = $validatedData['sifat_pengajuan'];

        if ($dataAdd->save()) {
            // Redirect to a success page or login page
            return redirect('/ajuan/daftar')->with('success', 'Penambahan Pengajuan Anggaran sukses diajukan, silahkan tunggu proses');
        } else {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
    }
}
