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
Route::get('/', fn () => redirect()->route('login'));

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
    | MASTER DATA
    |--------------------------------------------------------------------------
    */
    Route::resource('pasien', PasienController::class);
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('rekam-medis', RekamMedisController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('poli', PoliController::class);


    /*
    |--------------------------------------------------------------------------
    | CETAK
    |--------------------------------------------------------------------------
    */
    Route::get('pendaftaran/cetak/{id}', [PendaftaranController::class, 'cetak'])
        ->name('pendaftaran.cetak');

    Route::get('rekam-medis/{id}/print', [RekamMedisController::class, 'print'])
        ->name('rekam-medis.print');


    /*
    |--------------------------------------------------------------------------
    | AJAX - DOKTER BERDASARKAN POLI
    |--------------------------------------------------------------------------
    */
    Route::get('/get-dokter/{poli_id}', [DokterController::class, 'getByPoli'])
        ->name('dokter.byPoli');


    /*
    |--------------------------------------------------------------------------
    | LAB - DAFTAR SEMUA (UNTUK MENU)
    |--------------------------------------------------------------------------
    */
    Route::get('/lab-semua', [LabPemeriksaanController::class, 'index'])
        ->name('lab.semua');


    /*
    |--------------------------------------------------------------------------
    | LAB PEMERIKSAAN - PER REKAM MEDIS
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->name('lab.')->group(function () {

        // ✅ FORM TAMBAH LAB BERDASARKAN REKAM MEDIS
        Route::get('/{rekam_medis_id}/create', [LabPemeriksaanController::class, 'create'])
            ->whereNumber('rekam_medis_id')
            ->name('create');

        // ✅ LIST LAB (optional per rekam medis)
        Route::get('/{rekam_medis_id?}', [LabPemeriksaanController::class, 'index'])
            ->whereNumber('rekam_medis_id')
            ->name('index');

        // ✅ SIMPAN
        Route::post('/store', [LabPemeriksaanController::class, 'store'])
            ->name('store');

        // ✅ EDIT
        Route::get('/edit/{id}', [LabPemeriksaanController::class, 'edit'])
            ->whereNumber('id')
            ->name('edit');

        // ✅ UPDATE
        Route::put('/update/{id}', [LabPemeriksaanController::class, 'update'])
            ->whereNumber('id')
            ->name('update');

        // ✅ DELETE
        Route::delete('/destroy/{id}', [LabPemeriksaanController::class, 'destroy'])
            ->whereNumber('id')
            ->name('destroy');
    });

});
