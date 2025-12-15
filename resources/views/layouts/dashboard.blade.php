<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - POS Toko</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card { transition: transform 0.2s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); }
        /* Tambahan styling untuk layout sidebar */
        .sidebar { width: 16rem; } /* Lebar 256px */
        .content-area { margin-left: 16rem; } /* Harus sama dengan lebar sidebar */
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex">
    
    {{-- A. SIDEBAR TETAP (KIRI) --}}
    <div class="sidebar fixed bg-gray-800 text-white h-screen p-4 flex flex-col justify-between z-20 shadow-xl">
        <div>
            <h1 class="text-2xl font-bold mb-8 text-indigo-400">POS Toko</h1>
            
            {{-- Menu Navigasi --}}
            <nav class="space-y-2">
                <a href="{{ route('dashboard.index') }}" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700 transition duration-150 @if(Request::is('dashboard')) bg-gray-700 @endif">
                    <img src="https://img.icons8.com/ios-filled/20/ffffff/control-panel.png" alt="Dashboard">
                    <span>Dashboard</span>
                </a>
                {{-- Tambahkan semua link utama Anda di sini --}}
                <a href="/barang" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700 transition duration-150">
                    <img src="https://img.icons8.com/ios-filled/20/ffffff/box.png" alt="Barang">
                    <span>Barang</span>
                </a>
                <a href="/transaksi" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700 transition duration-150">
        <img src="https://img.icons8.com/ios-filled/20/ffffff/cash-in-hand.png" alt="Transaksi">
        <span>Transaksi</span>
    </a>
                <nav class="space-y-2">
    <a href="/laporan" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700 transition duration-150">
        <img src="https://img.icons8.com/ios-filled/20/ffffff/clipboard.png" alt="Laporan">
        <span>Laporan</span>
    </a>
     {{-- MENU KHUSUS ADMIN --}}
@if(Auth::user()->role === 'admin')
    <a href="{{ route('pegawai.index') }}"
       class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700 transition duration-150
       {{ Request::is('pegawai*') ? 'bg-gray-700' : '' }}">
        <img src="https://img.icons8.com/ios-filled/20/ffffff/conference.png" alt="Pegawai">
        <span>Kelola Pegawai</span>
    </a>
@endif
    </nav>
                {{-- ... menu lainnya ... --}}
                <a href="/profil" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-700 transition duration-150">
                    <img src="https://img.icons8.com/ios-filled/20/ffffff/user.png" alt="Profil">
                    <span>Profil Saya</span>
                </a>
            </nav>
        </div>
        
        {{-- Footer Sidebar (Opsional) --}}
        <div class="text-xs text-gray-500">
            © 2025 POS Toko Putri
        </div>
    </div>
    
    {{-- B. AREA KONTEN UTAMA (KANAN) --}}
    <div class="content-area w-full">
        
        {{-- Header/Navbar (DIPINDAHKAN DARI KODE ANDA) --}}
        <header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Halaman Utama')</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700">Selamat Datang, **{{ Auth::user()->name }}** ({{ Auth::user()->role }})</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- Konten Anak Disisipkan di Sini --}}
        <main class="p-8">
            @yield('content')
        </main>

    </div>
</body>
</html>