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
| REDIRECT LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | MASTER PASIEN
    |--------------------------------------------------------------------------
    */
    Route::resource('pasien', PasienController::class);

    /*
    |--------------------------------------------------------------------------
    | PENDAFTARAN
    |--------------------------------------------------------------------------
    */
    Route::resource('pendaftaran', PendaftaranController::class);

    Route::get('pendaftaran/cetak/{id}', 
        [PendaftaranController::class, 'cetak']
    )->name('pendaftaran.cetak');

    /*
    |--------------------------------------------------------------------------
    | REKAM MEDIS
    |--------------------------------------------------------------------------
    */
    Route::resource('rekam-medis', RekamMedisController::class);

    Route::get('rekam-medis/{id}/print', 
        [RekamMedisController::class, 'print']
    )->name('rekam-medis.print');

    /*
    |--------------------------------------------------------------------------
    | LAB PERIKSA
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->name('lab.')->group(function () {
        Route::get('/', [LabPemeriksaanController::class, 'index'])->name('index');
        Route::get('/create/{rekam_medis_id}', [LabPemeriksaanController::class, 'create'])->name('create');
        Route::post('/', [LabPemeriksaanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [LabPemeriksaanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LabPemeriksaanController::class, 'update'])->name('update');
        Route::delete('/{id}', [LabPemeriksaanController::class, 'destroy'])->name('destroy');
        Route::get('/rekam-medis/{rekam_medis_id}', [LabPemeriksaanController::class, 'index'])->name('byRekamMedis');
        Route::get('/{id}', [LabPemeriksaanController::class, 'show'])->name('show');
    });

    /*
    |--------------------------------------------------------------------------
    | OBAT / RESEP
    |--------------------------------------------------------------------------
    */
    Route::resource('obat', ObatController::class);

    /*
    |--------------------------------------------------------------------------
    | DOKTER
    |--------------------------------------------------------------------------
    */
    Route::resource('dokter', DokterController::class);

    Route::get('get-dokter/{poli_id}', 
        [DokterController::class, 'getByPoli']
    )->name('dokter.byPoli');

    /*
    |--------------------------------------------------------------------------
    | POLI
    |--------------------------------------------------------------------------
    */
    Route::resource('poli', PoliController::class);

    /*
    |--------------------------------------------------------------------------
    | KASIR / TRANSAKSI
    |--------------------------------------------------------------------------
    | → Route dibersihkan, lebih readable
    | → Memiliki route tambahan:
    |      transaksi.bayar (POST)
    |      transaksi.print (GET)
    |--------------------------------------------------------------------------
    */
    Route::prefix('transaksi')->name('transaksi.')->group(function () {

        // Resource utama (index, create, store, show, edit, update, delete)
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('create');
        Route::post('/', [TransaksiController::class, 'store'])->name('store');
        Route::get('/{id}', [TransaksiController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TransaksiController::class, 'update'])->name('update');
        Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('destroy');

        // Tambahan: BAYAR
        Route::post('/{id}/bayar', [TransaksiController::class, 'bayar'])
            ->name('bayar');

        // Tambahan: CETAK KWITANSI
        Route::get('/{id}/print', [TransaksiController::class, 'print'])
            ->name('print');
    });

});
