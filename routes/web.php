<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LabPemeriksaanController;
use App\Http\Controllers\PoliController;

/*
|--------------------------------------------------------------------------
| REDIRECT AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| LOGOUT (AUTH)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD (AUTH)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| MENU UTAMA (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | RESOURCE ROUTES
    |--------------------------------------------------------------------------
    */
    Route::resource('pasien', PasienController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('transaksi', TransaksiController::class);

    /** ✅ FIX UNTUK ERROR kamu */
    Route::resource('poli', PoliController::class);   // <-- INI YANG KURANG

    /*
    |--------------------------------------------------------------------------
    | CETAK ANTRIAN PENDAFTARAN
    |--------------------------------------------------------------------------
    */
    Route::get('pendaftaran/cetak/{id}', [PendaftaranController::class, 'cetak'])
        ->name('pendaftaran.cetak');


    /*
    |--------------------------------------------------------------------------
    | LAB PEMERIKSAAN  (SUDAH AMAN DARI ERROR)
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->name('lab.')->group(function () {

        // ✅ INI YANG DIPERBAIKI (parameter jadi OPTIONAL)
        Route::get('/{rekam_medis_id?}', [LabPemeriksaanController::class, 'index'])->name('index');

        Route::get('/{rekam_medis_id}/create', [LabPemeriksaanController::class, 'create'])->name('create');

        Route::post('/store', [LabPemeriksaanController::class, 'store'])->name('store');

        Route::get('/edit/{id}', [LabPemeriksaanController::class, 'edit'])->name('edit');

        Route::put('/update/{id}', [LabPemeriksaanController::class, 'update'])->name('update');

        Route::delete('/destroy/{id}', [LabPemeriksaanController::class, 'destroy'])->name('destroy');
    });

});
