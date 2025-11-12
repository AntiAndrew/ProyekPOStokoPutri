<?php

// ... Import Controllers ... (use App\Http\Controllers\Auth\AuthController; dll)
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController; 
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TransaksiController;



/*
|--------------------------------------------------------------------------
| Public Routes (Akses Tanpa Login)
|--------------------------------------------------------------------------
*/

// PERHATIAN: Perbaiki Route Default (/)
Route::get('/', function () {
    // Jika user sudah login, arahkan ke dashboard
    if (Auth::check()) { 
        return redirect()->route('dashboard.index');
    }
    // Jika belum login, arahkan ke login
    return redirect()->route('login');
});

// Route Login & Register (HARUS DITARUH DI SINI, DI LUAR MIDDLEWARE 'auth')
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// UBAH BARIS INI: Tambahkan nama 'login.post'
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 

// Route Password Reset (TAMBAHKAN INI)
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});

// Route Register (GET - Menampilkan Form)
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// UBAH BARIS INI: Tambahkan nama 'register.post'
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::resource('pegawai', PegawaiController::class);
/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Hanya diakses setelah Login)
|--------------------------------------------------------------------------
*/

// Semua route di dalam group ini WAJIB login dulu
Route::middleware(['auth'])->group(function () {
    
    // Route Dashboard Utama 
    Route::get('/dashboard', function () {
        return view('auth.dashboard'); 
    })->name('dashboard.index');


    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ... Route Admin dan Pegawai lainnya
    
 /* --- FITUR KELOLA BARANG --- */
    // Group route untuk Kelola Barang
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/', [BarangController::class, 'menu'])->name('menu');
        Route::get('/input', [BarangController::class, 'create'])->name('create');
        Route::get('/manage', [BarangController::class, 'manage'])->name('manage');
        Route::get('/cari', [BarangController::class, 'cari'])->name('cari');
        Route::get('/daftar', [BarangController::class, 'index'])->name('index');

        
    });
    // ROUTE UNTUK TRANSAKSI
      // 🔹 ROUTE TRANSAKSI PENJUALAN
Route::middleware(['auth'])->group(function () {
    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'menu'])->name('menu');
        Route::get('/daftar', [TransaksiController::class, 'index'])->name('index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('create');
        Route::post('/store', [TransaksiController::class, 'store'])->name('store');
        Route::get('/manage', [TransaksiController::class, 'manage'])->name('manage');
        Route::get('/{id}', [TransaksiController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [TransaksiController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TransaksiController::class, 'update'])->name('update');
          Route::delete('/destroy/{id}', [TransaksiController::class, 'destroy'])->name('destroy');
        Route::get('/cari', [TransaksiController::class, 'cari'])->name('cari');
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::get('/transaksi/menu', [TransaksiController::class, 'menu'])->name('transaksi.menu');
        // Di routes/web.php
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');


    });
});

// ROUTE UNTUK LAPORAN
Route::middleware(['auth'])->group(function () {
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/penjualan', [LaporanController::class, 'index'])->name('penjualan');
        Route::get('/transaksi', [LaporanController::class, 'transaksi'])->name('transaksi');
    
    });
});
});