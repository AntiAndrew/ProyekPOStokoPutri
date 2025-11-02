<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - POS Toko</title>
    <script src="https://cdn.tailwindcss.com"></script> 
    <style>
        .card { transition: transform 0.2s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-indigo-700">POS Toko</h1>
        <div class="flex items-center space-x-4">
            {{-- Halo 🥸 --}}
            <span class="text-gray-700">Selamat Datang, {{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">
            Dashboard Utama
        </h2>

        {{-- Logika Pembeda Konten Berdasarkan Role --}}
        @if (Auth::user()->role === 'admin')
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-2">Akses Administrator</h3>
                <p>Anda memiliki akses penuh untuk mengelola User dan semua Laporan.</p>
            </div>
            {{-- Menu Admin --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="/admin/pegawai" class="card bg-indigo-500 text-white p-6 rounded-lg text-center shadow-lg">Kelola Pegawai</a>
                <a href="/admin/barang" class="card bg-purple-500 text-white p-6 rounded-lg text-center shadow-lg">Kelola Barang</a>
                <a href="/admin/laporan" class="card bg-pink-500 text-white p-6 rounded-lg text-center shadow-lg">Laporan Total</a>
                <a href="/admin/settings" class="card bg-red-500 text-white p-6 rounded-lg text-center shadow-lg">Pengaturan Sistem</a>
            </div>

        @elseif (Auth::user()->role === 'pegawai')
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-2">Akses Pegawai</h3>
                <p>Silakan lakukan transaksi dan kelola barang yang diizinkan.</p>
            </div>
            {{-- Menu Pegawai --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="/barang" class="card bg-blue-500 text-white p-6 rounded-lg text-center shadow-lg">Kelola Barang</a>
                <a href="/transaksi" class="card bg-teal-500 text-white p-6 rounded-lg text-center shadow-lg">Transaksi Penjualan</a>
                <a href="/laporan" class="card bg-orange-500 text-white p-6 rounded-lg text-center shadow-lg">Laporan Transaksi</a>
                <a href="/profil" class="card bg-gray-500 text-white p-6 rounded-lg text-center shadow-lg">Profil Saya</a>
            </div>
            
        @else
            <div class="bg-red-100 p-4 rounded-lg">Role pengguna tidak terdeteksi.</div>
        @endif
    </main>
</body>
</html>
