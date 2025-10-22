<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


use App\Http\Controllers\Auth\AuthController;

// Login & Register

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('role:admin');
Route::middleware(['role:admin'])->group(function () {
    // route khusus admin
});



// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\PegawaiController;

Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');            // Lihat daftar pegawai
Route::get('/pegawai/tambah', [PegawaiController::class, 'create'])->name('pegawai.create');   // Form tambah pegawai
Route::post('/pegawai/simpan', [PegawaiController::class, 'store'])->name('pegawai.store');    // Simpan pegawai baru
Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');    // Form edit pegawai
Route::post('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update'); // Simpan perubahan
Route::get('/pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy'); // Hapus pegawai
Route::get('/pegawai/cari', [PegawaiController::class, 'search'])->name('pegawai.search');     // Cari pegawai

Route::get('/', function () {
    return view('welcome');
});
