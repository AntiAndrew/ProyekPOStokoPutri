<?php


// app/Http/Controllers/PegawaiProfilController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
// Hapus atau abaikan 'use App\Models\PegawaiModel;'

class PegawaiProfilController extends Controller
{
    public function index()
    {
        // 1. Ambil data user yang sedang login (semua data dari tabel 'users')
        $user = Auth::user(); 
        
        // 2. Kita tidak perlu mencari data detail pegawai lagi.
        // Cukup kirim $user saja ke view.
        // Catatan: Jika Anda tetap ingin mengirimkan variabel $pegawai (agar tidak merusak view), 
        // Anda bisa membuat variabel $pegawai sama dengan $user, TAPI ini tidak disarankan.
        
        // Untuk saat ini, kita akan mengirim $user ke view
        return view('pegawai.profil', compact('user'));
    }
}