<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Pastikan Anda memiliki Model User
use App\Models\Barang; // Ganti dengan nama Model Barang Anda
use App\Models\Transaksi; // Ganti dengan nama Model Transaksi Anda (Asumsi)

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // --- PENGAMBILAN DATA BARANG ---
        
        $stokKritisCount = Barang::where('jumlah_barang', '<', 10)->count(); 
        
        $data = [
            'stokKritisCount' => $stokKritisCount,
        ];
        
        // --- LOGIKA ROLE ADMIN ---
        if ($user->role === 'admin') {
            
            $data['totalPegawai'] = User::where('role', 'pegawai')->count();
            $data['totalBarang'] = Barang::count();
            
            // Asumsi: TransaksiModel sudah ada dan memiliki field 'total_harga'
            $data['penjualanHariIni'] = Transaksi::whereDate('tanggal', today())->sum('total_harga');

        // --- LOGIKA ROLE PEGAWAI ---
        } elseif ($user->role === 'pegawai') {
            
            // Asumsi: TransaksiModel sudah ada dan memiliki field 'user_id'
            $data['transaksiSayaHariIni'] = Transaksi::where('id_transaksi', $user->id)
                                                          ->whereDate('tanggal', today())
                                                          ->count();
        }

        // Kirim semua data ke view
        return view('auth.dashboard', $data);
    }
}