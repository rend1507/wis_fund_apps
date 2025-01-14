<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    // Define a private variable
    private $mainRoute= 'user';

    private function resetSession()
    {
        // Reset Session
        session()->forget('edit_id');
        session()->forget('action_id');
        session()->forget('route_id');
    }

    //
    public function index(Request $request)
    {
        $currentRoute = $this->mainRoute.".daftar";

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



        return view('pages.'. $this->mainRoute.'.daftar', ['currentRoute' => $currentRoute, 'data' => $data, ]);
    }
    public function tambah()
    {
        $this->resetSession();

        $currentRoute =  $this->mainRoute.".tambah";
        session(['action_id' => "tambah"]); // Store Action in session
        return view('pages.'.$this->mainRoute.'.form', ['currentRoute' => $currentRoute]);
    }

    public function editId($id)
    {


        session(['edit_id' => $id]); // Store ID in session
        session(['action_id' => "edit"]); // Store Action in session
        session(['route_id' => $this->mainRoute]); // Store ID of action in session

        return redirect()->route('user.edit'); // Return the edit form view
    }
    public function edit()
    {
        // Check if it from the User Edit, else, it redirect to home
        if (session("route_id") != $this->mainRoute) {
            return redirect()->route('home');
        }

        $currentRoute = "user.edit";

        $ajuan = User::find(session("edit_id"));
        return view('pages.'. $this->mainRoute .'.form', ['currentRoute' => $currentRoute, 'data' => $ajuan,]); // Return the edit form view
    }

    public function formAction(Request $request)
    {
        // INIT
        $message = "";
        $dataForm = null; // Initialize as null to prevent issues.

        $validatedData = $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|string',
            'password' => 'required|string', //TODO: encrypt
        ]);

        if (session("action_id") == "tambah") {
            $dataForm = new User();

            $dataForm->name = $validatedData['name'];
            $dataForm->email = $validatedData['email'];
            $dataForm->password = $validatedData['password'];

            $message = "Penambahan User berhasil";
        } elseif (session("action_id") == "edit" && session("edit_id")) {
            // Edit existing data
            $editId = session("edit_id");

            // Fetch the existing record
            $dataForm = User::find($editId);

            if (!$dataForm) {
                // If the record is not found, redirect with an error
                return redirect('/user/daftar')->with('error', 'Data pengajuan tidak ditemukan.');
            }

            // Update fields with validated data
            $dataForm->name = $validatedData['name'];
            $dataForm->email = $validatedData['email'];
            $dataForm->password = $validatedData['password'];

            $message = "User berhasil diperbarui.";
        }

        // Save the data
        if ($dataForm->save()) {
            return redirect('/user/daftar')->with('success', $message);
        } else {
            dd($validatedData);
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
    }


    public function hapusAction($id)
    {
        // Find the record by ID
        $data = User::find($id);

        if (!$data) {
            // If the record is not found, redirect with an error
            return redirect('/user/daftar')->with('error', 'Data User tidak ditemukan.');
        }

        // Attempt to delete the record
        if ($data->delete()) {
            // Redirect to the list page with a success message
            return redirect('/user/daftar')->with('success', 'User berhasil dihapus.');
        } else {
            // If deletion fails, redirect back with an error
            return redirect('/user/daftar')->with('error', 'User gagal dihapus.');
        }
    }

}
