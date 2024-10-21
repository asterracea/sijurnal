<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruPiketController;
Route::get('/', function () {
    return view('login');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Menampilkan form login
    Route::post('/login', [AuthController::class, 'login']); // Proses login
});
Route::middleware(['auth'])->group(function () {
    //superadmin
    Route::get('/home', [SuperAdminController::class, 'index'])->middleware('RoleMiddleware:superadmin')->name('home');

    //admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('RoleMiddleware:admin')->name('wellcome');
    Route::get('/admin/dataguru', [AdminController::class, 'dataguru'])->middleware('RoleMiddleware:admin')->name('dataguru');

    //guru
    Route::get('/guru/home', [GuruController::class, 'index'])->middleware('RoleMiddleware:guru')->name('guru/home');
    //gurupiket
    Route::get('/gurupiket/home', [GuruPiketController::class, 'index'])->middleware('RoleMiddleware:guru_piket')->name('gurupiket/home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
});

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
