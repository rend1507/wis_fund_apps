<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\PengajuanProses;
use Illuminate\Pagination\LengthAwarePaginator;

class AjuanController extends Controller
{
    //
    public function index(Request $request)
    {
        $currentRoute = "ajuan.daftar";

        $allData = Pengajuan::all();

        // Reset Action
        session()->forget('edit_id');
        session()->forget('action_id');

        // Current page number
        $currentPage = $request->get('page', 1);

        // Items per page
        $perPage = 10; //TODO: Set to global and can be modified within select box

        // Slice the data for the current page
        $currentPageData = $allData->slice(($currentPage - 1) * $perPage, $perPage);

        // Create a paginator
        $data = new LengthAwarePaginator(
            $currentPageData,
            $allData->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );



        return view('pages.ajuan.daftar', ['currentRoute' => $currentRoute, 'data' => $data, ]);
    }
    public function tambah()
    {
        $currentRoute = "ajuan.tambah";
        session(['action_id' => "tambah"]); // Store Action in session
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

    public function editId($id)
    {


        session(['edit_id' => $id]); // Store ID in session
        session(['action_id' => "edit"]); // Store Action in session
        // TODO: RENAME IT TO MAKE IT UNIVERSAL
        return redirect()->route('ajuan.edit'); // Return the edit form view
    }
    public function edit()
    {
        $currentRoute = "ajuan.edit";

        $ajuan = Pengajuan::find(session("edit_id"));
        // TODO: RENAME IT TO MAKE IT UNIVERSAL
        return view('pages.ajuan.tambah', ['currentRoute' => $currentRoute, 'data' => $ajuan,]); // Return the edit form view
    }

    public function editAction(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pengajuan' => 'required|string|max:40',
            'deskripsi_pengajuan' => 'nullable|string',
            'jumlah_anggaran_pengajuan' => 'required|integer',
            'detail_anggaran_pengajuan' => 'required|string',
            'sifat_pengajuan' => 'required|in:0,1',
        ]);

        // TODO: ACTION EDIT TO DB
         return redirect('/ajuan/daftar');
        // $dataAdd = new PengajuanProses();
        // $dataAdd->nama_pengajuan = $validatedData['nama_pengajuan'];
        // $dataAdd->deskripsi_pengajuan = $validatedData['deskripsi_pengajuan'];
        // $dataAdd->jumlah_anggaran_pengajuan = $validatedData['jumlah_anggaran_pengajuan'];
        // $dataAdd->detail_anggaran_pengajuan = $validatedData['detail_anggaran_pengajuan'];
        // $dataAdd->sifat_pengajuan = $validatedData['sifat_pengajuan'];

        // if ($dataAdd->save()) {
        //     // Redirect to a success page or login page
        //     return redirect('/ajuan/daftar')->with('success', 'Penambahan Pengajuan Anggaran sukses diajukan, silahkan tunggu proses');
        // } else {
        //     return redirect()->back()->withInput()->withErrors($validatedData);
        // }
    }
}
