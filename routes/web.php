<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AjuanController;
use App\Http\Controllers\UserController;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login/auth', [LoginController::class, 'actionLogin'])->name('login.auth');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name("register");
    Route::post('/register/auth', [RegisterController::class, 'actionRegister'])->name('register.auth');
});

Route::get('/logout', [LoginController::class, 'actionLogout'])->name('logout')->middleware('auth');


Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/ajuan/tambah', [AjuanController::class, 'tambah'])->name('ajuan.tambah')->middleware('auth');
Route::get('/ajuan/daftar', [AjuanController::class, 'index'])->name('ajuan.daftar')->middleware('auth');
Route::get('/ajuan/edit/{id}', [AjuanController::class, 'editId'])->name('ajuan.editId')->middleware('auth');
Route::get('/ajuan/edit/', [AjuanController::class, 'edit'])->name('ajuan.edit')->middleware('auth');
Route::get('/ajuan/hapus/{id}', [AjuanController::class, 'hapusAction'])->name('ajuan.hapus');

Route::post('/ajuan/action', [AjuanController::class, 'formAction'])->name('ajuan.form.action')->middleware('auth');

Route::get('/ajuan/setujui/{id}', [AjuanController::class, 'setujuiPengajuan'])->name('ajuan.setujui')->middleware('auth');



Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user.tambah')->middleware('auth');
Route::get('/user/daftar', [UserController::class, 'index'])->name('user.daftar')->middleware('auth');
Route::get('/user/edit/{id}', [UserController::class, 'editId'])->name('user.editId')->middleware('auth');
Route::get('/user/edit/', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::get('/user/hapus/{id}', [UserController::class, 'hapusAction'])->name('user.hapus');

Route::get('/user/action', [UserController::class, 'formAction'])->name('user.form.action')->middleware('auth');
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