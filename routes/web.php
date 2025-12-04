<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController; 
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiProfilController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;  
use Illuminate\Support\Facades\Hash; // Ensure Hash is available if needed, though usually used in controller/model

/*
|--------------------------------------------------------------------------
| Public Routes (Akses Tanpa Login)
|--------------------------------------------------------------------------
*/

// Route Default: Redirects based on authentication status
Route::get('/', function () {
    if (Auth::check()) { 
        return redirect()->route('dashboard.index');
    }
    return redirect()->route('login');
});

// Authentication Routes (Outside 'auth' middleware)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Password Reset Routes
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Hanya diakses setelah Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Route Dashboard Utama
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
    
    // Pastikan ini ada dan namanya 'pegawai.profil'
    Route::get('/profil', [PegawaiProfilController::class, 'index'])->name('pegawai.profil');

    
    /* --- FITUR KELOLA BARANG --- */
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('index'); // Daftar
        Route::get('/menu', [BarangController::class, 'menu'])->name('menu');
        Route::get('/create', [BarangController::class, 'create'])->name('create');
        Route::post('/store', [BarangController::class, 'store'])->name('store');
        Route::get('/manage', [BarangController::class, 'manage'])->name('manage');
        Route::get('/cari', [BarangController::class, 'cari'])->name('cari');
        Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BarangController::class, 'update'])->name('update');
        Route::delete('/{id}', [BarangController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [BarangController::class, 'show'])->name('show'); // Tambahkan show jika ada
    });

    /* --- ROUTE UNTUK TRANSAKSI --- */
    /* ============================
       PEGAWAI ROUTES (ADMIN ONLY!)
       ============================ */
     /* ============================
    PEGAWAI ROUTES (ADMIN ONLY)
    ============================ */
    Route::middleware(['role:admin'])->group(function () {
        Route::prefix('pegawai')->name('pegawai.')->group(function () {
            Route::get('/', [PegawaiController::class, 'index'])->name('index');
            Route::get('/menu', [PegawaiController::class, 'menu'])->name('menu'); // Tambahkan menu
            Route::get('/create', [PegawaiController::class, 'create'])->name('create');
            Route::post('/', [PegawaiController::class, 'store'])->name('store');

            // Resource methods
            Route::get('/{id}/edit', [PegawaiController::class, 'edit'])->name('edit');
            Route::put('/{id}', [PegawaiController::class, 'update'])->name('update');
            Route::delete('/{id}', [PegawaiController::class, 'destroy'])->name('destroy');
            Route::get('/{id}', [PegawaiController::class, 'show'])->name('show'); // SHOW Detail

            // Search route must be defined before {id}
            Route::get('/search', [PegawaiController::class, 'search'])->name('search'); 
        });
});
// Sudah ada yang lain seperti CRUD, biarkan saja



    // ROUTE UNTUK TRANSAKSI
      // 🔹 ROUTE TRANSAKSI PENJUALAN
Route::middleware(['auth'])->group(function () {

    // 🔹 ROUTE TRANSAKSI PENJUALAN
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'menu'])->name('menu'); // Menu Transaksi
        Route::get('/daftar', [TransaksiController::class, 'index'])->name('index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('create');
        Route::post('/store', [TransaksiController::class, 'store'])->name('store');
        Route::get('/manage', [TransaksiController::class, 'manage'])->name('manage');
        Route::get('/cari', [TransaksiController::class, 'cari'])->name('cari');
        Route::get('/{id}', [TransaksiController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TransaksiController::class, 'update'])->name('update');
        Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('destroy');
    });

    /* --- LAPORAN ROUTES (Untuk semua user yang login) --- */
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/penjualan', [LaporanController::class, 'index'])->name('penjualan'); // Alias ke index
        Route::get('/transaksi', [LaporanController::class, 'transaksi'])->name('transaksi');
});
});


