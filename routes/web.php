<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('login');
});
Route::get('/admin/dashboard', function () {
    return view('dashboard');
});
Route::get('/admin/dataguru', function () {
    return view('/admin/dataguru');
});
Route::get('/layouts/admin', function () {
    return view('/layouts/admin');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin/dataguru', [AccountController::class, 'index'])->name('dataguru');
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
