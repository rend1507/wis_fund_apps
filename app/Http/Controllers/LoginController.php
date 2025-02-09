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

            // Validate the password before continuing
            //  && Hash::check($password, $user->password)
            if ($user) {
                $role = $key;
                break;
            }

            $user = null;
        }

        // If user not found or password is incorrect
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'E-mail dan password salah, silahkan cek ulang']);
        }


        // Clear and regenerate session
        session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Store role securely in the session
        session(['user_role' => encrypt($role)]);

        // Log the user in
        Auth::login($user);
        $user = Auth::user(); // Get the logged-in user
        session(['user_name' => encrypt($user->name)]);
        session(['user_role' => encrypt($role)]);

        return redirect('');
        // } else {
        //     return redirect()->back()->withErrors(['error' => 'E-mail dan password salah, silahkan cek ulang']);
        // }

    }


    public function actionLogout()
    {
        Auth::logout();
        return redirect('/login');
    }
}