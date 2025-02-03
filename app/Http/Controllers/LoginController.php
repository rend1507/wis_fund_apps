<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\UserBasic;
use App\Models\UserMed;
use App\Models\UserAdmin;



class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('');
        } else {
            return view('login');
        }
    }

    public function actionLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $validatedData['email'];
        $password = $validatedData['password'];
        $roles = [
            'basic' => UserBasic::class,
            'admin' => UserAdmin::class,
            'med' => UserMed::class,
        ];

        $user = null;
        $role = null;

        foreach ($roles as $key => $model) {
            $user = $model::where('email', $email)->first();
            if ($user) {
                $role = $key; // Assign the corresponding role
                break; // Exit loop as soon as a user is found
            }else{
                $user = null;
            }

        }



        // If user not found or password is incorrect
        //  || !Hash::check($password, $user->password
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'E-mail dan password salah, silahkan cek ulang']);
        }


        // Log the user in
        Auth::login($user);

        // Regenerate session ID to prevent session fixation attacks
        $request->session()->regenerate();

        // Store role securely in the session
        session(['user_role' => encrypt($role)]);


        // Redirect based on role (optional)

        return redirect('');
    }


    public function actionLogout()
    {
        Auth::logout();
        return redirect('/login');
    }
}