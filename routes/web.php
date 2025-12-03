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
Route::get('/', fn() => redirect()->route('login'));

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
| DASHBOARD (AUTH) - Menu 1
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

    /*
    |--------------------------------------------------------------------------
    | PENDAFTARAN - Menu 3
    |--------------------------------------------------------------------------
    */
    Route::resource('pendaftaran', PendaftaranController::class);
    
    // Cetak Antrian Pendaftaran
    Route::get('pendaftaran/cetak/{id}',
        [PendaftaranController::class, 'cetak']
    )->name('pendaftaran.cetak');

    /*
    |--------------------------------------------------------------------------
    | REKAM MEDIS - Menu 4
    |--------------------------------------------------------------------------
    */
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('poli', PoliController::class);

    /*
    |--------------------------------------------------------------------------
    | CETAK REKAM MEDIS (PDF) — WAJIB DITAMBAHKAN
    |--------------------------------------------------------------------------
    */
    Route::get('rekam-medis/{id}/print', [RekamMedisController::class, 'print'])
        ->name('rekam-medis.print');

    /*
    |--------------------------------------------------------------------------
    | ROUTE AJAX GET DOKTER BERDASARKAN POLI
    |--------------------------------------------------------------------------
    */
    Route::get('/get-dokter/{poli_id}', [DokterController::class, 'getByPoli'])
        ->name('dokter.byPoli');

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA - POLI - Submenu 2
    |--------------------------------------------------------------------------
    */
    Route::resource('poli', PoliController::class);

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA - PERJAMIN (Belum ada controller)
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->name('lab.')->group(function () {
        Route::get('/{rekam_medis_id}', [LabPemeriksaanController::class, 'index'])->name('index');
        Route::get('/{rekam_medis_id}/create', [LabPemeriksaanController::class, 'create'])->name('create');
        Route::post('/store', [LabPemeriksaanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LabPemeriksaanController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [LabPemeriksaanController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [LabPemeriksaanController::class, 'destroy'])->name('destroy');
    });

});
