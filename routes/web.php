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
    // 1. Rute CRUD Resource (Index, Create, Store, Edit, Update, Destroy)
    // Semua aksi ini hanya bisa diakses setelah login
    Route::resource('barang', BarangController::class);

    // 2. Rute Pencarian Barang Tambahan
    Route::get('/barang/cari', [BarangController::class, 'cari'])->name('barang.cari');
    /* ============================
       PEGAWAI ROUTES (ADMIN ONLY!)
       ============================ */
    Route::middleware(['role:admin'])->group(function () {

    // Menu pegawai
    Route::get('/pegawai/menuPegawai', [PegawaiController::class, 'menu'])->name('pegawai.menu');


    // Resource pegawai (kecuali show)
    Route::resource('pegawai', PegawaiController::class)->except(['show']);
});
// Sudah ada yang lain seperti CRUD, biarkan saja

}); 