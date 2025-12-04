@extends('layouts.dashboard') {{-- Panggil Layout Sidebar Baru --}}

@section('title', 'Dashboard Utama') {{-- Mengisi title browser --}}
@section('page-title', 'Ringkasan Dashboard') {{-- Mengisi judul di header --}}

@section('content')

    {{-- Logika Pembeda Konten Berdasarkan Role --}}
    @if (Auth::user()->role === 'admin')
        
        <h3 class="text-xl font-bold mb-4 text-gray-700">Ringkasan Kinerja</h3>

        {{-- Kartu Statistik Administrator (LENGKAP) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            {{-- 1. TOTAL PENJUALAN HARI INI --}}
            <div class="card bg-green-600 text-white p-5 rounded-lg shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-80">PENJUALAN HARI INI</p>
                    <p class="text-3xl font-bold mt-1">Rp 1.500.000</p> {{-- TODO: Ganti dengan nilai dinamis --}}
                </div>
                <img src="https://img.icons8.com/ios-filled/50/ffffff/coin-wallets.png" alt="Penjualan">
            </div>

            {{-- 2. STOK KRITIS --}}
            <div class="card bg-red-600 text-white p-5 rounded-lg shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-80">BARANG STOK KRITIS</p>
                    <p class="text-3xl font-bold mt-1">{{ $stokKritisCount }}</p> 
                </div>
                <img src="https://img.icons8.com/ios-filled/50/ffffff/stocks.png" alt="Stok Kritis">
            </div>
            
            {{-- 3. TOTAL BARANG --}}
            <div class="card bg-teal-600 text-white p-5 rounded-lg shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-80">TOTAL VARIASI BARANG</p>
                    <p class="text-3xl font-bold mt-1">120</p> {{-- TODO: Ganti dengan nilai dinamis --}}
                </div>
                <img src="https://img.icons8.com/ios-filled/50/ffffff/box.png" alt="Total Barang">
            </div>

            {{-- 4. TOTAL PEGAWAI --}}
            <div class="card bg-indigo-600 text-white p-5 rounded-lg shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-80">TOTAL PEGAWAI AKTIF</p>
                    <p class="text-3xl font-bold mt-1">5 Orang</p> {{-- TODO: Ganti dengan nilai dinamis --}}
                </div>
                <img src="https://img.icons8.com/ios-filled/50/ffffff/staff.png" alt="Pegawai">
            </div>
        </div>

        {{-- Area Grafik/Laporan (Disarankan untuk Admin) --}}
        <div class="bg-white p-6 rounded-lg shadow-xl mb-8">
            <h3 class="text-xl font-semibold mb-4 text-gray-700">Grafik Produk Terlaris Bulan Ini</h3>
            <p class="text-gray-500">TODO: Tempatkan grafik Top 5 produk di sini.</p>
        </div>
        
        
        
    @elseif (Auth::user()->role === 'pegawai')
        
        <h3 class="text-xl font-bold mb-4 text-gray-700">Akses Pegawai</h3>

        {{-- Kartu Fokus Pegawai --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            {{-- 1. TOMBOL TRANSAKSI (Paling Penting) --}}
            <a href="/transaksi" class="card bg-yellow-500 text-white p-8 rounded-lg text-center shadow-lg transform hover:scale-105 transition duration-200 col-span-2">
                <img src="https://img.icons8.com/ios-filled/60/ffffff/cash-in-hand.png" class="mx-auto mb-3" alt="Transaksi">
                <h3 class="text-2xl font-bold">MULAI TRANSAKSI BARU</h3>
            </a>

            {{-- 2. STOK KRITIS --}}
            <div class="card bg-red-600 text-white p-5 rounded-lg shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-80">STOK HAMPIR HABIS</p>
                    <p class="text-3xl font-bold mt-1">{{ $stokKritisCount  }}</p> {{-- TODO: Ganti dengan nilai dinamis --}}
                </div>
                <img src="https://img.icons8.com/ios-filled/50/ffffff/stocks.png" alt="Stok Kritis">
            </div>
            
            {{-- 3. TRANSAKSI SAYA HARI INI --}}
            <div class="card bg-indigo-600 text-white p-5 rounded-lg shadow-xl flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium opacity-80">TRANSAKSI SAYA (HARI INI)</p>
                    <p class="text-3xl font-bold mt-1">12 Kali</p> {{-- TODO: Ganti dengan nilai dinamis --}}
                </div>
                <img src="https://img.icons8.com/ios-filled/50/ffffff/checked-checkbox.png" alt="Transaksi Hari Ini">
            </div>
        </div>
        
        
        
    @else
        <div class="bg-red-100 p-4 rounded-lg">Role pengguna tidak terdeteksi.</div>
    @endif
    
@endsection