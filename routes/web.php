<?php

// ... Import Controllers ... (use App\Http\Controllers\Auth\AuthController; dll)
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BarangController; 
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

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
    Route::resource('barang', BarangController::class);
    Route::get('/barang/cari', [BarangController::class, 'cari'])->name('barang.cari');

    /* --- FITUR TRANSAKSI PENJUALAN --- */
    use App\Http\Controllers\TransaksiController;
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/tambah', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/simpan', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/edit/{id}', [TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
