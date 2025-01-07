<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjuanController;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login/auth', [LoginController::class, 'actionLogin'])->name('login.auth');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name("register");
    Route::post('/register/auth', [RegisterController::class, 'actionRegister'])->name('register.auth');
});

Route::get('/logout', [LoginController::class, 'actionLogout'])->name('logout')->middleware('auth');


Route::get('', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/ajuan/tambah', [AjuanController::class, 'tambah'])->name('ajuan.tambah')->middleware('auth');
Route::get('/ajuan/tambah/action', [AjuanController::class, 'tambahAction'])->name('ajuan.tambah.action')->middleware('auth');
Route::get('/ajuan/daftar', [AjuanController::class, 'index'])->name('ajuan.daftar')->middleware('auth');


Route::get('/ajuan/edit/{id}', [AjuanController::class, 'editId'])->name('ajuan.editId')->middleware('auth');
Route::get('/ajuan/edit/', [AjuanController::class, 'edit'])->name('ajuan.edit')->middleware('auth');
Route::get('/ajuan/edit/action', [AjuanController::class, 'editAction'])->name('ajuan.edit.action')->middleware('auth');

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