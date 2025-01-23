<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    // Define a private variable
    private $mainRoute = 'user';

    private function resetSession()
    {
        // Reset Session
        session()->forget($this->mainRoute . '_edit_id');
    }

    //
    public function index(Request $request)
    {
        $currentRoute = $this->mainRoute . ".daftar";

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



        return view('pages.' . $this->mainRoute . '.daftar', ['currentRoute' => $currentRoute, 'data' => $data,]);
    }
    public function tambah()
    {
        $this->resetSession();

        $currentRoute = $this->mainRoute . ".tambah";
        return view('pages.' . $this->mainRoute . '.form', ['currentRoute' => $currentRoute]);
    }

    public function editId($id)
    {
        session([$this->mainRoute . '_edit_id' => $id]); // Store ID in session
        return redirect()->route('user.edit'); // Return the edit form view
    }
    public function edit()
    {

        $currentRoute = $this->mainRoute . ".edit";

        $user = User::find(session($this->mainRoute . '_edit_id'));

        if (!$user) {
            // Handle the error, e.g., show an error message or redirect
            return redirect()->route('user.daftar')->with('error', 'User tidak ditemukan');
        }
        return view('pages.' . $this->mainRoute . '.form', ['currentRoute' => $currentRoute, 'data' => $user,]); // Return the edit form view
    }
    public function formAction(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:255', // Validate email and limit length
            'password' => 'required|string|min:8|max:255', // Ensure minimum length for security
            'id' => 'nullable|integer', // Add id validation for edit
        ]);

        // Initialize variables
        $dataForm = null;
        $message = "";
        $previousUrl = url()->previous();

        if (str_contains($previousUrl, 'user/tambah')) {
            $dataForm = new User();
            $message = "Penambahan User berhasil.";
        } elseif (str_contains($previousUrl, 'user/edit')) {
            if (empty($validatedData['id'])) {
                return redirect('/user/daftar')->with('danger', 'ID user tidak ditemukan.');
            }

            $dataForm = User::find($validatedData['id']);

            if (!$dataForm) {
                return redirect('/user/daftar')->with('danger', 'Data user tidak ditemukan.');
            }

            $message = "User berhasil diperbarui.";
        }

        // Populate and save the data
        $dataForm->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        // Save and return response
        if ($dataForm->save()) {
            return redirect('/user/daftar')->with('success', $message);
        }

        return redirect()->back()->withInput()->withErrors('Terjadi kesalahan saat menyimpan data.');
    }



    public function hapusAction($id)
    {
        // Find the record by ID
        $data = User::find($id);

        // Check if it was current user's id
        if ($id != auth()->user()->id) {
            if (!$data) {
                // If the record is not found, redirect with an error
                return redirect('/user/daftar')->with('danger', 'Data User tidak ditemukan.');
            }

            // Attempt to delete the record
            if ($data->delete()) {
                // Redirect to the list page with a success message
                return redirect('/user/daftar')->with('success', 'User berhasil dihapus.');
            } else {
                // If deletion fails, redirect back with an error
                return redirect('/user/daftar')->with('danger', 'User gagal dihapus.');
            }

        } else {
            return redirect('/user/daftar')->with('danger', 'Anda tidak bisa hapus user anda!');
        }
    }

}
