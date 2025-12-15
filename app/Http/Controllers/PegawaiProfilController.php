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
        // 1. Ambil data user yang sedang login
        $user = Auth::user(); 
        
        // 2. Ganti nama view agar sesuai dengan file: profil_saya.blade.php
        return view('Pegawai.profil', compact('user')); // <-- Perbaikan di sini!
    }
}