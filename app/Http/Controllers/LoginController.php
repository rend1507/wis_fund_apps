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
            return redirect('home');
        } else {
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];


        $user = User::where('email', $data["email"])->first();

        //  || !Hash::check($data["password"], $user->password)

        if (!$user) {
            $request->merge(['user_id' => auth()->id()]); // Example of passing user ID to middleware
            $request->merge(['action' => 'login']); // Example of passing action to middleware
            // Invalid credentials
            return redirect()->back()->withErrors(['error' => 'Invalid email or password']);
        }

        // Valid credentials, log the user in
        // You can use Laravel's Auth facade to log the user in
        Auth::login($user);


        return redirect('home');
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/login');
    }
}