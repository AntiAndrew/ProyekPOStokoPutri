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

        /* Form and utility styles copied from layouts.app to keep form look consistent */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body { font-family: 'Inter', sans-serif; }

        .form-page { padding: 1rem; }

        .form-container {
            background-color: #ffffff;
            padding: 1.25rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.04);
            max-width: 720px;
            margin: 0 auto;
        }

        .page-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: #111827; }

        .alert-danger-custom {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
        }

        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #111827; }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #D1D5DB;
            border-radius: 8px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.03);
            transition: border-color 0.2s, background-color 0.2s;
        }

        .form-group input:focus, .form-group select:focus { border-color: #A6D1E6; outline: none; }

        .form-btn-bottom { display: flex; justify-content: space-between; margin-top: 20px; }

        .btn-save, .btn-cancel, .btn-reset {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.2s, transform 0.15s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-save { background-color: #10B981; color: white; border: none; }
        .btn-cancel { background-color: #edcb77; color: #0d132a; border: none; }
        .btn-reset { background-color: #EF4444; color: white; border: none; }

        .btn-save:hover, .btn-cancel:hover, .btn-reset:hover { transform: translateY(-2px); }
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
    <a href="{{ route('pegawai.menu') }}"
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