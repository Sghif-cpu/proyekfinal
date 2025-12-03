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
    | PASIEN - Menu 2
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
    
    // Cetak Rekam Medis (PDF)
    Route::get('rekam-medis/{id}/print',
        [RekamMedisController::class, 'print']
    )->name('rekam-medis.print');

    /*
    |--------------------------------------------------------------------------
    | LAB PEMERIKSAAN - Menu 5
    |--------------------------------------------------------------------------
    */
    Route::prefix('lab')->name('lab.')->group(function () {
        // List semua pemeriksaan lab (opsional: lihat berdasarkan rekam medis)
        Route::get('/{rekam_medis_id?}', [LabPemeriksaanController::class, 'index'])->name('index');
        
        // Form create pemeriksaan lab (tanpa parameter)
        Route::get('/create', [LabPemeriksaanController::class, 'create'])->name('create');
        
        // Simpan data lab
        Route::post('/', [LabPemeriksaanController::class, 'store'])->name('store');
        
        // Detail lab
        Route::get('/{id}', [LabPemeriksaanController::class, 'show'])->name('show');
        
        // Edit lab
        Route::get('/{id}/edit', [LabPemeriksaanController::class, 'edit'])->name('edit');
        
        // Update lab
        Route::put('/{id}', [LabPemeriksaanController::class, 'update'])->name('update');
        
        // Hapus lab
        Route::delete('/{id}', [LabPemeriksaanController::class, 'destroy'])->name('destroy');
        
        // Route khusus jika ingin lihat lab berdasarkan rekam medis
        Route::get('/rekam-medis/{rekam_medis_id}', 
            [LabPemeriksaanController::class, 'byRekamMedis']
        )->name('byRekamMedis');
    });

    /*
    |--------------------------------------------------------------------------
    | OBAT & RESEP - Menu 6
    |--------------------------------------------------------------------------
    */
    Route::resource('obat', ObatController::class);

    /*
    |--------------------------------------------------------------------------
    | KASIR (Transaksi) - Menu 7
    |--------------------------------------------------------------------------
    */
    Route::resource('transaksi', TransaksiController::class);

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA - DOKTER - Submenu 1
    |--------------------------------------------------------------------------
    */
    Route::resource('dokter', DokterController::class);
    
    // Ajax Dokter By Poli
    Route::get('get-dokter/{poli_id}',
        [DokterController::class, 'getByPoli']
    )->name('dokter.byPoli');

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
    // Route::resource('perjamin', PerjaminController::class);
});