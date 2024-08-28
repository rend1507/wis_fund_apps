<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login/auth', [LoginController::class, 'actionLogin'])->name('login.auth');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name("register");
    Route::post('/register/auth', [RegisterController::class, 'actionRegister'])->name('register.auth');
});

Route::get('/logout', [LoginController::class, 'actionLogout'])->name('logout')->middleware('auth');


Route::get('', [HomeController::class, 'index'])->name('')->middleware('auth');

// Route::group(['middleware' => 'checkRole:0,1'], function () {
//     // Routes accessible to Admin and Superadmin

//     Route::get('home', [HomeController::class, 'index'])->name('home');
// });

// Route::group(['middleware' => 'checkRole:2,3,4'], function () {
//     // Routes accessible to Employee, Supervisor, and Finance

//     Route::get('home', [HomeController::class, 'index'])->name('home');
// });

// Route::group(['middleware' => 'checkRole:5,6'], function () {
//     // Routes accessible to Principle and Director

//     Route::get('home', [HomeController::class, 'index'])->name('home');
// });