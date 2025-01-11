<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    private function resetSession()
    {
        // Reset Session
        session()->forget('edit_id');
        session()->forget('action_id');
    }

    //
    public function index(Request $request)
    {
        $currentRoute = "user.daftar";

        $allData = User::all();
        
        $this->resetSession();

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



        return view('pages.user.daftar', ['currentRoute' => $currentRoute, 'data' => $data, ]);
    }
    public function tambah()
    {
        $this->resetSession();

        $currentRoute = "ajuan.tambah";
        session(['action_id' => "tambah"]); // Store Action in session
        return view('pages.user.form', ['currentRoute' => $currentRoute]);
    }

    public function editId($id)
    {


        session(['edit_id' => $id]); // Store ID in session
        session(['action_id' => "edit"]); // Store Action in session
        return redirect()->route('ajuan.edit'); // Return the edit form view
    }
    public function edit()
    {
        $currentRoute = "ajuan.edit";

        $ajuan = PengajuanPending::find(session("edit_id"));
        return view('pages.user.form', ['currentRoute' => $currentRoute, 'data' => $ajuan,]); // Return the edit form view
    }

    public function formAction(Request $request)
    {
        $message = "";

        $validatedData = $request->validate([
            'nama_pengajuan' => 'required|string|max:40',
            'deskripsi_pengajuan' => 'nullable|string',
            'jumlah_anggaran_pengajuan' => 'required|integer',
            'detail_anggaran_pengajuan' => 'required|string',
            'sifat_pengajuan' => 'required|in:0,1',
        ]);


        $dataForm = null; // Initialize as null to prevent issues.

        if (session("action_id") == "tambah") {
            $dataForm = new PengajuanPending();

            $dataForm->nama_pengajuan = $validatedData['nama_pengajuan'];
            $dataForm->deskripsi_pengajuan = $validatedData['deskripsi_pengajuan'];
            $dataForm->jumlah_anggaran_pengajuan = $validatedData['jumlah_anggaran_pengajuan'];
            $dataForm->detail_anggaran_pengajuan = $validatedData['detail_anggaran_pengajuan'];
            $dataForm->sifat_pengajuan = $validatedData['sifat_pengajuan'];

            $message = "Penambahan Pengajuan Anggaran sukses diajukan, silahkan tunggu proses";
        } elseif (session("action_id") == "edit" && session("edit_id")) {
            // Edit existing data
            $editId = session("edit_id");

            // Fetch the existing record
            $dataForm = PengajuanPending::find($editId);

            if (!$dataForm) {
                // If the record is not found, redirect with an error
                return redirect('/ajuan/daftar')->with('error', 'Data pengajuan tidak ditemukan.');
            }

            // Update fields with validated data
            $dataForm->nama_pengajuan = $validatedData['nama_pengajuan'];
            $dataForm->deskripsi_pengajuan = $validatedData['deskripsi_pengajuan'];
            $dataForm->jumlah_anggaran_pengajuan = $validatedData['jumlah_anggaran_pengajuan'];
            $dataForm->detail_anggaran_pengajuan = $validatedData['detail_anggaran_pengajuan'];
            $dataForm->sifat_pengajuan = $validatedData['sifat_pengajuan'];

            $message = "Pengajuan Anggaran berhasil diperbarui.";
        }

        // Save the data
        if ($dataForm->save()) {
            return redirect('/user/daftar')->with('success', $message);
        } else {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
    }


    public function hapusAction($id)
    {
        // Find the record by ID
        $data = PengajuanPending::find($id);

        if (!$data) {
            // If the record is not found, redirect with an error
            return redirect('/user/daftar')->with('error', 'Data pengajuan tidak ditemukan.');
        }

        // Attempt to delete the record
        if ($data->delete()) {
            // Redirect to the list page with a success message
            return redirect('/user/daftar')->with('success', 'Pengajuan Anggaran berhasil dihapus.');
        } else {
            // If deletion fails, redirect back with an error
            return redirect('/user/daftar')->with('error', 'Pengajuan Anggaran gagal dihapus.');
        }
    }

}
