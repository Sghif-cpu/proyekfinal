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
| AUTH ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| MAIN SYSTEM (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA ROUTES
    |--------------------------------------------------------------------------
    */
    Route::resource('pasien', PasienController::class);
    Route::resource('dokter', DokterController::class);
    Route::resource('obat', ObatController::class);
    Route::resource('poli', PoliController::class);
    Route::resource('penjamin', PenjaminController::class);

    /*
    |--------------------------------------------------------------------------
    | PELAYANAN ROUTES
    |--------------------------------------------------------------------------
    */
    // Pendaftaran
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::get('pendaftaran/cetak/{id}', [PendaftaranController::class, 'cetak'])
        ->name('pendaftaran.cetak');

    // Rekam Medis
    Route::resource('rekam-medis', RekamMedisController::class);

    // 📌 Print Rekam Medis
    Route::get('rekam-medis/{id}/print', [RekamMedisController::class, 'print'])
        ->name('rekam-medis.print');


    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI ROUTES
    |--------------------------------------------------------------------------
    */
    Route::resource('transaksi', TransaksiController::class);

    // 📌 Route BAYAR (menyelesaikan error RouteNotFound)
    Route::post('transaksi/{id}/bayar', [TransaksiController::class, 'bayar'])
        ->name('transaksi.bayar');

    // 📌 (Opsional) Jika butuh cetak struk
    // Route::get('transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])
    //     ->name('transaksi.cetak');


    /*
    |--------------------------------------------------------------------------
    | LABORATORIUM ROUTES
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->name('lab.')->group(function () {

        Route::get('/', [LabPemeriksaanController::class, 'index'])->name('index');

        Route::get('/create', [LabPemeriksaanController::class, 'create'])->name('create');
        Route::get('/create/{rekam_medis_id}', 
            [LabPemeriksaanController::class, 'create']
        )->name('create.with.rm');

        Route::post('/', [LabPemeriksaanController::class, 'store'])->name('store');

        Route::get('/rekam-medis/{rekam_medis_id}', 
            [LabPemeriksaanController::class, 'byRekamMedis']
        )->name('byRekamMedis');

        Route::get('/{id}/edit', [LabPemeriksaanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [LabPemeriksaanController::class, 'update'])->name('update');
        Route::delete('/{id}', [LabPemeriksaanController::class, 'destroy'])->name('destroy');

        // SHOW harus paling terakhir
        Route::get('/{id}', [LabPemeriksaanController::class, 'show'])->name('show');
    });

});
