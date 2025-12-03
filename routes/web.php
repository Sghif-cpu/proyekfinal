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
use App\Http\Controllers\PenjaminController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| MAIN SYSTEM (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // MASTER DATA + MENU
    Route::resource('pasien', PasienController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('poli', PoliController::class);

    // ⭐ PENJAMIN — ROUTE YANG KAMU BUTUHKAN
    Route::resource('penjamin', PenjaminController::class);

    // CETAK ANTRIAN
    Route::get('pendaftaran/cetak/{id}', [PendaftaranController::class, 'cetak'])
        ->name('pendaftaran.cetak');

    /*
    |--------------------------------------------------------------------------
    | LAB PEMERIKSAAN (TIDAK ADA ROUTE PENJAMIN DI SINI)
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->name('lab.')->group(function () {

        Route::get('/{rekam_medis_id?}', [LabPemeriksaanController::class, 'index'])->name('index');
        Route::get('/{rekam_medis_id}/create', [LabPemeriksaanController::class, 'create'])->name('create');
        Route::post('/store', [LabPemeriksaanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LabPemeriksaanController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [LabPemeriksaanController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [LabPemeriksaanController::class, 'destroy'])->name('destroy');
    });

});
