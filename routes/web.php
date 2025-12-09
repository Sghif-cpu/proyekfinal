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
| MAIN SYSTEM (PROTECTED - AUTH REQUIRED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout (harus dalam auth karena hanya user login yang bisa logout)
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
    
    // Transaksi
    Route::resource('transaksi', TransaksiController::class);

    /*
    |--------------------------------------------------------------------------
    | LABORATORIUM ROUTES (PERBAIKAN UTAMA)
    |--------------------------------------------------------------------------
    */
Route::prefix('lab')->name('lab.')->group(function () {

    // INDEX
    Route::get('/', [LabPemeriksaanController::class, 'index'])->name('index');

    // CREATE
    Route::get('/create', [LabPemeriksaanController::class, 'create'])->name('create');
    Route::get('/create/{rekam_medis_id}', [LabPemeriksaanController::class, 'create'])
        ->name('create.with.rm');

    // STORE
    Route::post('/', [LabPemeriksaanController::class, 'store'])->name('store');

    // ROUTE KHUSUS REKAM MEDIS (harus sebelum {id})
    Route::get('/rekam-medis/{rekam_medis_id}', 
        [LabPemeriksaanController::class, 'byRekamMedis']
    )->name('byRekamMedis');

    // EDIT
    Route::get('/{id}/edit', [LabPemeriksaanController::class, 'edit'])->name('edit');

    // UPDATE
    Route::put('/{id}', [LabPemeriksaanController::class, 'update'])->name('update');

    // DELETE
    Route::delete('/{id}', [LabPemeriksaanController::class, 'destroy'])->name('destroy');

    // SHOW — harus paling terakhir!
    Route::get('/{id}', [LabPemeriksaanController::class, 'show'])->name('show');
});

});