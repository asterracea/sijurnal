<?php
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return Auth::check() ? view('home') : redirect('/login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // Menampilkan form login
Route::post('/login', [AuthController::class, 'login']); // Proses login

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //superadmin
    Route::prefix('superadmin')->middleware('RoleMiddleware:superadmin')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('dashboard');
    });


    // Rute Admin
    Route::prefix('admin')->middleware('RoleMiddleware:admin')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('wellcome');

        // Data Guru
        //Route::get('/dataguru', [AdminController::class, 'dataguru'])->name('dataguru');
        // Route::get('/create-dataguru', [CreateDataGuruController::class, 'create'])->name('create_dataguru');
        // Route::post('/store-dataguru', [CreateDataGuruController::class, 'store'])->name('store_dataguru');


        //admin
        //Route::get('/dashboard', [AdminController::class, 'index'])->middleware('RoleMiddleware:admin')->name('wellcome');
        //Route::get('/admin/dataguru', [AdminController::class, 'dataguru'])->middleware('RoleMiddleware:admin')->name('dataguru');
        Route::get('/dataguru', [DataGuruController::class, 'index'])->name('dataguru');
        Route::post('/dataguru/store', [DataGuruController::class, 'store'])->name('dataguru.store');
        Route::get('/dataguru/{nip}/edit', [DataGuruController::class, 'edit'])->name('dataguru.edit');
        Route::put('/dataguru/{nip}', [DataGuruController::class, 'update'])->name('dataguru.update');
        Route::delete('/dataguru/{nip}', [DataGuruController::class, 'destroy'])->name('dataguru.destroy');
        Route::get('/dataguru/{nip}/akun', [DataGuruController::class, 'showAccount'])->name('guru.account');

        //create user
        Route::get('/userpage/{nip}', [UserPageController::class, 'show'])->name('userpage.show');
        Route::get('/userpage/{nip}', [UserPageController::class, 'show'])->name('user.page');
        Route::get('/userpage', [UserPageController::class, 'index'])->name('userpage');
        Route::get('/userpage/{nip}', [UserPageController::class, 'showByGuru'])->name('userpage.showByGuru');
        Route::post('/userpage', [UserPageController::class, 'store'])->name('userpage.store');
        Route::put('/userpage/{nip}', [UserPageController::class, 'update'])->name('userpage.update');
        Route::delete('/userpage/{nip}', [UserPageController::class, 'destroy'])->name('userpage.destroy');


        Route::get('/datauser', [AdminController::class, 'viewUser'])->name('datauser');
        Route::get('/datauser/{id_user}', [AdminController::class, 'edit'])->name('admin.editdatauser');
        Route::put('/datauser/{id_user}', [AdminController::class, 'update'])->name('admin.updatedatauser');

        Route::post('/datauser', [AdminController::class, 'store'])->name('admin.createdatauser');
        //Route::get('/admin/datauser', [AdminController::class, 'create'])->name('user.create');

        // Data Jadwal
        Route::get('/datajadwal', [CreateJadwalController::class, 'index'])->name('datajadwal');
        Route::post('/datajadwal', [CreateJadwalController::class, 'store'])->name('datajadwal.store');
        Route::put('/datajadwal/{id_jadwal}', [CreateJadwalController::class, 'update'])->name('datajadwal.update');
        Route::delete('/datajadwal/{id_jadwal}', [CreateJadwalController::class, 'destroy'])->name('datajadwal.destroy');

        // Jadwal Kelas
        Route::get('/jadwalkelas10', [JadwalKelas10Controller::class, 'index'])->name('jadwalkelas10');
        Route::post('/jadwalkelas10', [JadwalKelas10Controller::class, 'store'])->name('jadwalkelas10.store');
        Route::get('/jadwalkelas11', [JadwalKelas11Controller::class, 'index'])->name('jadwalkelas11');
        Route::post('/jadwalkelas11', [JadwalKelas11Controller::class, 'store'])->name('jadwalkelas11.store');
        Route::get('/jadwalkelas12', [JadwalKelas12Controller::class, 'index'])->name('jadwalkelas12');
        Route::post('/jadwalkelas12', [JadwalKelas12Controller::class, 'store'])->name('jadwalkelas12.store');

        // Tahun Ajaran
        Route::get('/tahun', [CreateTahunController::class, 'index'])->name('tahun');
        Route::post('/tahun', [CreateTahunController::class, 'store'])->name('tahun.store');
        Route::put('/tahun/{id_tahun}', [CreateTahunController::class, 'update'])->name('tahun.update');
        Route::delete('/tahun/{id_tahun}', [CreateTahunController::class, 'destroy'])->name('tahun.destroy');

        // Kelas
        Route::get('/kelas', [CreateKelasController::class, 'index'])->name('kelas');
        Route::post('/kelas', [CreateKelasController::class, 'store'])->name('kelas.store');
        Route::put('/kelas/{id_kelas}', [CreateKelasController::class, 'update'])->name('kelas.update');
        Route::delete('/kelas/{id_kelas}', [CreateKelasController::class, 'destroy'])->name('kelas.destroy');

        // Mata Pelajaran
        Route::get('/mapel', [CreateMapelController::class, 'index'])->name('mapel');
        Route::post('/mapel', [CreateMapelController::class, 'store'])->name('mapel.store');
        Route::put('/mapel/{id_mapel}', [CreateMapelController::class, 'update'])->name('mapel.update');
        Route::delete('/mapel/{id_mapel}', [CreateMapelController::class, 'destroy'])->name('mapel.destroy');

        Route::get('/gurupiket', [AdminController::class, 'datapiket'])->name('gurupiket');
        Route::post('/gurupiket', [AdminController::class, 'createpiket'])->name('gurupiket.createpiket');
        Route::put('/gurupiket/{id_piket}', [AdminController::class, 'updatepiket'])->name('gurupiket.updatepiket');
        Route::delete('/gurupiket/{id_piket}', [AdminController::class, 'destroy'])->name('kelas.destroy');

        // Jurnal
        Route::get('/jurnal', [AdminController::class, 'viewjurnal'])->name('datajurnal');

        // Akun Pengguna
        //Route::get('/account_user', [AccUserController::class, 'index'])->name('account_user');
        //Route::get('/jurnal', [AdminController::class, 'viewjurnal'])->name('datajurnal');

        Route::get('/userpage', [UserPageController::class, 'index'])->name('userpage');
        // // Route::get('/admin/create_dataguru', [CreateDataGuruController::class, 'index'])->name('create_dataguru');
    });



    //guru
    Route::prefix('guru')->middleware('RoleMiddleware:guru')->group(function () {
        // Dashboard Guru
        Route::get('/home', [GuruController::class, 'index'])->name('guru/home');

        // Form Jurnal
        Route::get('/formjurnal', [FormJurnalController::class, 'index'])->name('formjurnal');

        // Jurnal
        Route::get('/jurnal', [GuruController::class, 'viewjurnal'])->name('guru/jurnal');
        Route::post('/jurnal', [GuruController::class, 'store'])->name('jurnal.store');
        Route::get('/jurnal/edit/{id_jurnal}', [GuruController::class, 'edit'])->name('guru.editjurnal');
        Route::put('/jurnal/update/{id_jurnal}', [GuruController::class, 'update'])->name('guru.updatejurnal');

        // Route::get('/guru/home', [GuruController::class, 'index'])->middleware('RoleMiddleware:guru')->name('guru/home');
        // Route::get('/guru/formjurnal', [FormJurnalController::class, 'index'])->middleware('RoleMiddleware:guru')->name('formjurnal');
        // Route::get('/guru/jurnal', [GuruController::class, 'viewjurnal'])->middleware('RoleMiddleware:guru')->name('guru/jurnal');
    });



    //gurupiket
    Route::prefix('guru_piket')->middleware('RoleMiddleware:guru_piket')->group(function () {
        Route::get('/gurupiket/home', [GuruPiketController::class, 'index'])->name('gurupiket/home');
    });

});


// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
