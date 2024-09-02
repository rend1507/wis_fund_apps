<?php

namespace App\Http\Controllers;

use App\Models\UserBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function actionRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'verification' => 'required|same:password',
        ]);

        $user = new UserBase();
        $user->name_user_base = $request->name;
        $user->email_user_base = $request->email;
        $user->password_user_base = Hash::make($request->password);
        
        if($user->save()){
            // Redirect to a success page or login page
            return redirect('/login')->with('success', 'Registration successful. Please log in.');
        }else{
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
    }
}