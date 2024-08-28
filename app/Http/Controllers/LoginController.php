<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

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

        // Check if email is valid before querying the database
        $email = $validatedData['email'];

        // Query the database with the validated email
        $user = User::where('email', $email)->first();

        // Untuk password
        //  || !Hash::check($data["password"], $user->password)

        if (!$user) {
            $request->merge(['email' => $email]);
            $request->merge(['action' => 'login']);
            // Invalid credentials
            // return false;
            return redirect()->back()->withErrors($validatedData);
        }else{
            // Valid credentials, log the user in
            // You can use Laravel's Auth facade to log the user in
            Auth::login($user);

            return redirect('');

        }
    }

    public function actionLogout()
    {
        Auth::logout();
        return redirect('/login');
    }
}