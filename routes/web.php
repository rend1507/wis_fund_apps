<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

use App\Http\Middleware\CheckRoleMiddleware;

Route::get('/login', function () {
    return view('login');
});

// TODO: Terapin auth 
Route::post('/login/auth', [LoginController::class, 'actionlogin']);

Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout');



// routes/web.php

Route::group(['middleware' => 'CheckRole:0,1'], function () {
    // Routes accessible to Admin and Superadmin

    Route::get('home', [HomeController::class, 'index'])->name('home');
});

Route::group(['middleware' => 'CheckRole:2,3,4'], function () {
    // Routes accessible to Employee, Supervisor, and Finance

    Route::get('home', [HomeController::class, 'index'])->name('home');
});

Route::group(['middleware' => 'CheckRole:5,6'], function () {
    // Routes accessible to Principle and Director

    Route::get('home', [HomeController::class, 'index'])->name('home');
});