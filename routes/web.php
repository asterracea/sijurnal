<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateKelasController;
use App\Http\Controllers\CreateMapelController;
use App\Http\Controllers\CreateTahunController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruPiketController;
use App\Http\Controllers\FormJurnalController;
use App\Http\Controllers\CreateJadwalController;
use App\Http\Controllers\JadwalKelas10Controller;
use App\Http\Controllers\JadwalKelas11Controller;
use App\Http\Controllers\JadwalKelas12Controller;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\DataGuruController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Menampilkan form login
Route::post('/login', [AuthController::class, 'login']); // Proses login

Route::middleware(['auth'])->group(function () {
    //superadmin
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->middleware('RoleMiddleware:superadmin')->name('dashboard');

    //admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('RoleMiddleware:admin')->name('wellcome');
    Route::get('/admin/dataguru', [AdminController::class, 'dataguru'])->middleware('RoleMiddleware:admin')->name('dataguru');
    Route::get('/admin/dataguru', [DataGuruController::class, 'index'])->name('dataguru');
    Route::post('/dataguru/store', [DataGuruController::class, 'store'])->name('dataguru.store');
    Route::get('/dataguru/{nip}/edit', [DataGuruController::class, 'edit'])->name('dataguru.edit');
    Route::put('/dataguru/{nip}', [DataGuruController::class, 'update'])->name('dataguru.update');
    Route::delete('/dataguru/{nip}', [DataGuruController::class, 'destroy'])->name('dataguru.destroy');
    Route::get('/dataguru/{nip}/akun', [DataGuruController::class, 'showAccount'])->name('guru.account');

    //create user
    Route::get('/userpage/{nip}', [UserPageController::class, 'show'])->name('userpage.show');
    Route::get('/admin/userpage/{nip}', [UserPageController::class, 'show'])->name('user.page');
    Route::get('/admin/userpage', [UserPageController::class, 'index'])->name('userpage');
    Route::get('/admin/userpage/{nip}', [UserPageController::class, 'showByGuru'])->name('userpage.showByGuru');
    Route::post('/admin/userpage', [UserPageController::class, 'store'])->name('userpage.store');
    Route::put('/admin/userpage/{nip}', [UserPageController::class, 'update'])->name('userpage.update');
    Route::delete('/admin/userpage/{nip}', [UserPageController::class, 'destroy'])->name('userpage.destroy');


    Route::get('/admin/datauser', [AdminController::class, 'viewUser'])->middleware('RoleMiddleware:admin')->name('datauser');
    Route::get('/admin/datauser/{id_user}', [AdminController::class, 'edit'])->middleware('RoleMiddleware:admin')->name('admin.editdatauser');
    Route::put('/admin/datauser/{id_user}', [AdminController::class, 'update'])->middleware('RoleMiddleware:admin')->name('admin.updatedatauser');

    Route::post('/admin/datauser', [AdminController::class, 'store'])->middleware('RoleMiddleware:admin')->name('admin.createdatauser');
    //Route::get('/admin/datauser', [AdminController::class, 'create'])->name('user.create');

    Route::get('/admin/datajadwal', [CreateJadwalController::class, 'index'])->middleware('RoleMiddleware:admin')->name('datajadwal');
    Route::post('/admin/datajadwal', [CreateJadwalController::class, 'store'])->middleware('RoleMiddleware:admin')->name('datajadwal.store');
    Route::put('/admin/datajadwal/{id_jadwal}', [CreateJadwalController::class, 'update'])->middleware('RoleMiddleware:admin')->name('datajadwal.update');
    Route::delete('/admin/datajadwal/{id_jadwal}', [CreateJadwalController::class, 'destroy'])->middleware('RoleMiddleware:admin')->name('datajadwal.destroy');

    Route::get('/admin/jadwalkelas10', [JadwalKelas10Controller::class, 'index'])->middleware('RoleMiddleware:admin')->name('jadwalkelas10');
    Route::post('/admin/jadwalkelas10', [JadwalKelas10Controller::class, 'store'])->middleware('RoleMiddleware:admin')->name('jadwalkelas10.store');

    Route::get('/admin/jadwalkelas11', [JadwalKelas11Controller::class, 'index'])->middleware('RoleMiddleware:admin')->name('jadwalkelas11');
    Route::post('/admin/jadwalkelas11', [JadwalKelas11Controller::class, 'store'])->middleware('RoleMiddleware:admin')->name('jadwalkelas11.store');

    Route::get('/admin/jadwalkelas12', [JadwalKelas12Controller::class, 'index'])->middleware('RoleMiddleware:admin')->name('jadwalkelas12');
    Route::post('/admin/jadwalkelas12', [JadwalKelas12Controller::class, 'store'])->middleware('RoleMiddleware:admin')->name('jadwalkelas12.store');

    Route::get('/admin/tahun', [CreateTahunController::class, 'index'])->middleware('RoleMiddleware:admin')->name('tahun');
    Route::post('/admin/tahun', [CreateTahunController::class, 'store'])->middleware('RoleMiddleware:admin')->name('tahun.store');
    Route::put('/admin/tahun/{id_tahun}', [CreateTahunController::class, 'update'])->middleware('RoleMiddleware:admin')->name('tahun.update');
    Route::delete('/admin/tahun/{id_tahun}', [CreateTahunController::class, 'destroy'])->middleware('RoleMiddleware:admin')->name('tahun.destroy');

    Route::get('/admin/kelas', [CreateKelasController::class, 'index'])->middleware('RoleMiddleware:admin')->name('kelas');
    Route::post('/admin/kelas', [CreateKelasController::class, 'store'])->middleware('RoleMiddleware:admin')->name('kelas.store');
    Route::put('/admin/kelas/{id_kelas}', [CreateKelasController::class, 'update'])->middleware('RoleMiddleware:admin')->name('kelas.update');
    Route::delete('/admin/kelas/{id_kelas}', [CreateKelasController::class, 'destroy'])->middleware('RoleMiddleware:admin')->name('kelas.destroy');

    Route::get('/admin/mapel', [CreateMapelController::class, 'index'])->middleware('RoleMiddleware:admin')->name('mapel');
    Route::post('/admin/mapel', [CreateMapelController::class, 'store'])->middleware('RoleMiddleware:admin')->name('mapel.store');
    Route::put('/admin/mapel/{id_mapel}', [CreateMapelController::class, 'update'])->middleware('RoleMiddleware:admin')->name('mapel.update');
    Route::delete('/admin/mapel/{id_mapel}', [CreateMapelController::class, 'destroy'])->middleware('RoleMiddleware:admin')->name('mapel.destroy');

    Route::get('/admin/jurnal', [AdminController::class, 'viewjurnal'])->middleware('RoleMiddleware:admin')->name('datajurnal');

    Route::get('/admin/userpage', [UserPageController::class, 'index'])->name('userpage');
    // // Route::get('/admin/create_dataguru', [CreateDataGuruController::class, 'index'])->name('create_dataguru');

    //guru
    Route::get('/guru/home', [GuruController::class, 'index'])->middleware('RoleMiddleware:guru')->name('guru/home');
    Route::get('/guru/formjurnal', [FormJurnalController::class, 'index'])->middleware('RoleMiddleware:guru')->name('formjurnal');
    Route::get('/guru/jurnal', [GuruController::class, 'viewjurnal'])->middleware('RoleMiddleware:guru')->name('guru/jurnal');


    //gurupiket
    Route::get('/gurupiket/home', [GuruPiketController::class, 'index'])->middleware('RoleMiddleware:guru_piket')->name('gurupiket/home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
