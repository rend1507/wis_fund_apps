<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanPending;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AjuanController extends Controller
{
    private $mainRoute = 'ajuan';

    private function resetSession()
    {
        // Reset Session
        session()->forget($this->mainRoute . '_edit_id');
    }

    //
    public function index(Request $request)
    {
        $currentRoute = $this->mainRoute . ".daftar";

        $allData = PengajuanPending::all();

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



        return view('pages.' . $this->mainRoute . '.daftar', ['currentRoute' => $currentRoute, 'data' => $data,]);
    }
    public function tambah()
    {
        $this->resetSession();

        $currentRoute = $this->mainRoute . ".tambah";
        session(['action_id' => "tambah"]); // Store Action in session
        return view('pages.' . $this->mainRoute . '.form', ['currentRoute' => $currentRoute]);
    }

    public function editId($id)
    {
        session([$this->mainRoute . '_edit_id' => $id]); // Store ID in session
        return redirect()->route($this->mainRoute . '.edit'); // Return the edit form view
    }
    public function edit()
    {

        $currentRoute = $this->mainRoute . ".edit";

        $ajuan = PengajuanPending::find(session($this->mainRoute . '_edit_id'));


        if (!$ajuan) {
            // Handle the error, e.g., show an error message or redirect
            return redirect()->route('ajuan.daftar')->with('error', 'Ajuan tidak ditemukan');
        }

        return view('pages.' . $this->mainRoute . '.form', ['currentRoute' => $currentRoute, 'data' => $ajuan,]); // Return the edit form view
    }
    public function formAction(Request $request)
    {
        // Common validation rules
        $rules = [
            'nama_pengajuan' => 'required|string|max:40',
            'deskripsi_pengajuan' => 'nullable|string',
            'jumlah_anggaran_pengajuan' => 'required|integer',
            'detail_anggaran_pengajuan' => 'required|string',
            'sifat_pengajuan' => 'required|in:0,1',
        ];

        $previousUrl = url()->previous();

        if (str_contains($previousUrl, $this->mainRoute . '/edit')) {
            $rules['id_pengajuan'] = 'required|integer';
        }

        // Validate input
        $validatedData = $request->validate($rules);

        // Initialize variables
        $dataForm = null;
        $message = "";

        if (str_contains($previousUrl, $this->mainRoute . '/tambah')) {
            $dataForm = new PengajuanPending();
            $message = "Tambah Pengajuan berhasil.";
        } elseif (str_contains($previousUrl, $this->mainRoute . '/edit')) {
            $dataForm = PengajuanPending::find($validatedData['id_pengajuan']);

            if (!$dataForm) {
                return redirect($this->mainRoute . '/daftar')->with('danger', 'Data Pengajuan tidak ditemukan.');
            }

            $message = "Pengajuan berhasil diperbarui.";
        }

        // Populate and save the data
        $dataForm->fill([
            'nama_pengajuan' => $validatedData['nama_pengajuan'],
            'deskripsi_pengajuan' => $validatedData['deskripsi_pengajuan'] ?? '-',
            'jumlah_anggaran_pengajuan' => $validatedData['jumlah_anggaran_pengajuan'],
            'detail_anggaran_pengajuan' => $validatedData['detail_anggaran_pengajuan'],
            'sifat_pengajuan' => $validatedData['sifat_pengajuan'],
        ]);

        // Save and return response
        if ($dataForm->save()) {
            return redirect($this->mainRoute . '/daftar')->with('success', $message);
        }

        return redirect()->back()->withInput()->withErrors('Terjadi kesalahan saat menyimpan data.');
    }




    public function hapusAction($id)
    {
        // Find the record by ID
        $data = PengajuanPending::find($id);

        if (!$data) {
            // If the record is not found, redirect with an error
            return redirect('/ajuan/daftar')->with('danger', 'Data pengajuan tidak ditemukan.');
        }

        // Attempt to delete the record
        if ($data->delete()) {
            // Redirect to the list page with a success message
            return redirect('/ajuan/daftar')->with('success', 'Pengajuan Anggaran berhasil dihapus.');
        } else {
            // If deletion fails, redirect back with an error
            return redirect('/ajuan/daftar')->with('danger', 'Pengajuan Anggaran gagal dihapus.');
        }
    }

    public function setujuiPengajuan($id)
    {
        try {
            // Menjalankan prosedur SQL untuk menyetujui pengajuan
            DB::statement("CALL setujui_pengajuan(?)", [$id]);
    
            // Jika berhasil, redirect ke daftar pengajuan dengan pesan sukses
            return redirect('/ajuan/daftar')->with('success', 'Pengajuan Anggaran berhasil disetujui.');
    
        } catch (\Exception $e) {
            // Log error untuk membantu debugging
    
            // Jika terjadi error, redirect ke daftar pengajuan dengan pesan error
            return redirect('/ajuan/daftar')->with('danger', 'Terjadi kesalahan saat memproses pengajuan.');
        }
    }

    

}
