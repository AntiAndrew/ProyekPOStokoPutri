<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - POS Toko</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        /* FIX PENTING: pastikan card bisa diklik dan selalu berada paling atas */
        a.card {
            position: relative;
            z-index: 10;
            display: block;
        }
    </style>
</head>

<body class="bg-green-100 min-h-screen">

    <!-- HEADER -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-indigo-700">POS Toko Putri</h1>

        <div class="flex items-center space-x-4">
            <span class="text-gray-700">
                Selamat Datang, {{ Auth::user()->name }} ({{ Auth::user()->role }})
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-8 text-gray-800">Dashboard Utama</h2>

        {{-- ROLE ADMIN --}}
        @if (Auth::user()->role === 'admin')

            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-2">Akses Administrator</h3>
                <p>Anda memiliki akses penuh untuk mengelola User dan semua Laporan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="/pegawai/menu"class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                     <img src="https://img.icons8.com/ios-filled/50/ffffff/staff.png" class="mx-auto mb-3" alt="Kelola Pegawai">
                     Kelola Pegawai
                    </a>
                <a href="/barang" class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/box.png"
                         class="mx-auto mb-3">
                    Kelola Barang
                </a>

                <a href="/transaksi" class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/cash-in-hand.png"
                         class="mx-auto mb-3">
                    Transaksi Penjualan
                </a>

                <a href="/laporan" class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/clipboard.png"
                         class="mx-auto mb-3">
                    Laporan Transaksi
                </a>
            </div>

        {{-- ROLE PEGAWAI --}}
        @elseif (Auth::user()->role === 'pegawai')

            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-2">Akses Pegawai</h3>
                <p>Silakan lakukan transaksi dan kelola barang yang diizinkan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="/barang" class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/box.png"
                         class="mx-auto mb-3">
                    Kelola Barang
                </a>

                <a href="/transaksi" class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/cash-register.png"
                         class="mx-auto mb-3">
                    Transaksi Penjualan
                </a>

                <a href="/laporan" class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/document.png"
                         class="mx-auto mb-3">
                    Laporan Transaksi
                </a>

                <a href="{{ route('pegawai.profil') }}"
                   class="card bg-yellow-500 text-white p-6 rounded-lg text-center shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/user.png"
                         class="mx-auto mb-3">
                    Profil Saya
                </a>

            </div>

        @else
            <div class="bg-red-100 p-4 rounded-lg">
                Role pengguna tidak terdeteksi.
            </div>
        @endif

    </main>

</body>
</html>
