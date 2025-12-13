<?php

// ... Import Controllers ... (use App\Http\Controllers\Auth\AuthController; dll)
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PegawaiProfilController;
use App\Http\Controllers\DashboardController;
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


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Hanya diakses setelah Login)
|--------------------------------------------------------------------------
*/

// Semua route di dalam group ini WAJIB login dulu
Route::middleware(['auth'])->group(function () {
    
    
    // Gunakan Controller baru untuk menangani logika dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/profil', [PegawaiProfilController::class, 'index'])->name('profil.index');


    // Route Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ... Route Admin dan Pegawai lainnya
    
    /* --- FITUR KELOLA BARANG --- */
    Route::prefix('barang')->name('barang.')->group(function () {
    Route::get('/', [BarangController::class, 'menu'])->name('menu');
    Route::get('/input', [BarangController::class, 'create'])->name('create');
    Route::post('/input', [BarangController::class, 'store'])->name('store');
    Route::get('/manage', [BarangController::class, 'manage'])->name('manage');
    Route::put('/update/{id}', [BarangController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [BarangController::class, 'destroy'])->name('destroy');
    Route::get('/daftar', [BarangController::class, 'index'])->name('index');
    Route::get('/cari', [BarangController::class, 'cari'])->name('cari');
    Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('edit');
    Route::get('/hapus', [BarangController::class, 'hapus'])->name('hapus');

});

    // 2. Rute Pencarian Barang Tambahan
    Route::get('/barang/cari', [BarangController::class, 'cari'])->name('barang.cari');

    // ROUTE UNTUK LAPORAN PENJUALAN (ADMIN DAN PEGAWAI)
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/penjualan', [LaporanController::class, 'index'])->name('penjualan');
    });

    /* ============================
       PEGAWAI ROUTES (ADMIN ONLY!)
       ============================ */
    Route::middleware(['role:admin'])->group(function () {

    // Menu pegawai
    Route::get('/pegawai/menuPegawai', [PegawaiController::class, 'menu'])->name('pegawai.menu');
    Route::get('/pegawai/menuPegawai', [PegawaiController::class, 'menu'])->name('pegawai.index');



    // Resource pegawai (kecuali show)
    Route::resource('pegawai', PegawaiController::class)->except(['show']);

    // ROUTE UNTUK LAPORAN TRANSAKSI (ADMIN ONLY)
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/transaksi', [LaporanController::class, 'transaksi'])->name('transaksi');
    });
});
// Sudah ada yang lain seperti CRUD, biarkan saja

}); 

    // ROUTE UNTUK TRANSAKSI
      // 🔹 ROUTE TRANSAKSI PENJUALAN
Route::middleware(['auth'])->group(function () {

    // DEFINISI RUTE HOME (dipindahkan ke sini)
    // Nama rute ini akan murni 'home', URL-nya /home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 🔹 ROUTE TRANSAKSI PENJUALAN
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

        // Hapus definisi rute yang duplikat atau tidak diperlukan di sini (seperti /transaksi/{id}, dll.)
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
        Route::get('/transaksi/menu', [TransaksiController::class, 'menu'])->name('transaksi.menu');
        // Di routes/web.php
        Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
        Route::delete('/transaksi/destroy/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');



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
