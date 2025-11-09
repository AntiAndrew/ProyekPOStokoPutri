<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Toko | @yield('title', 'Dashboard')</title>
    
    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Konfigurasi Tailwind & Font Inter -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'pastel-light': '#F3FDE8', // Background utama
                        'pastel-accent': '#FFD384', // Warna aksen kuning/krem
                        'pastel-green': '#A6D1E6', // Warna aksen hijau/biru
                        'pastel-dark': '#383E56', // Warna teks/judul
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Gaya CSS Kustom untuk tampilan yang spesifik -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f7f7; /* Background default */
        }
        
        /* Layout untuk halaman barang (yang memiliki desain unik) */
        .app-container-barang {
            background-color: #E6F3E6; /* Warna hijau muda untuk halaman internal */
            min-height: 100vh;
            padding: 1rem;
        }

        /* Gaya untuk pesan sukses/error (sesuai Blade yang kita buat) */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border-radius: 0.25rem;
        }

        /* Gaya Khusus untuk Tabel Data (List, Manage, Cari) */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px; /* Spasi antar baris */
        }
        .data-table th {
            background-color: #B0C7B0;
            color: #383E56;
            padding: 12px 16px;
            text-align: left;
        }
        .data-table td {
            background-color: white;
            padding: 12px 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .data-table tr:hover td {
            background-color: #f0fff0;
        }
        .data-table thead tr th:first-child,
        .data-table tbody tr td:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .data-table thead tr th:last-child,
        .data-table tbody tr td:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        
        /* Gaya untuk Tombol Aksi (Edit/Hapus) di Tabel */
        .action-cell .btn-icon {
            display: inline-block;
            padding: 4px 8px;
            margin: 0 2px;
            border-radius: 4px;
            transition: transform 0.2s;
        }
        .action-cell .btn-icon:hover {
            transform: scale(1.1);
        }
        
        /* Gaya untuk form */
        .form-page input[type="text"],
        .form-page input[type="number"],
        .form-page select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #D1D5DB;
            border-radius: 8px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
            transition: border-color 0.3s;
        }
        .form-page input:focus, .form-page select:focus {
            border-color: #A6D1E6;
            outline: none;
        }
        .form-page label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #383E56;
        }

        /* Gaya Tombol Bawah Form */
        .form-btn-bottom {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn-save, .btn-cancel, .btn-reset {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-save { background-color: #10B981; color: white; }
        .btn-cancel { background-color: #FBBF24; color: #383E56; }
        .btn-reset { background-color: #EF4444; color: white; }
        .btn-save:hover, .btn-cancel:hover, .btn-reset:hover { transform: translateY(-1px); }
    </style>
    
</head>
<body class="bg-pastel-light">

    {{-- Container Utama Aplikasi --}}
    <div class="app-container-barang">
        
        {{-- Header UI - Sesuai Desain Halaman Internal (Back, Home, Account) --}}
        <div class="header-ui flex justify-between items-center p-4 bg-white/70 backdrop-blur-sm rounded-lg shadow-md mb-6 sticky top-0 z-10">
            <div class="flex items-center space-x-4">
                {{-- Tombol Back - Perlu diimplementasikan di masing-masing halaman untuk fungsionalitas yang benar --}}
                <button onclick="history.back()" class="bg-pastel-accent hover:bg-pastel-accent/80 text-pastel-dark font-bold p-2 rounded-full shadow-lg transition duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </button>
                
                {{-- Tombol Home (Dashboard) --}}
                <a href="{{ route('dashboard.index') }}" class="bg-pastel-accent hover:bg-pastel-accent/80 text-pastel-dark font-bold p-2 rounded-full shadow-lg transition duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </a>
            </div>
            
            <h1 class="text-2xl font-bold text-pastel-dark">@yield('title')</h1>

            {{-- My Account Icon (Sesuai desain Anda) --}}
            <div class="account-icon bg-pastel-accent/50 p-2 rounded-full shadow-md text-pastel-dark cursor-pointer hover:bg-pastel-accent">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
        </div>

        {{-- Konten Utama Halaman --}}
        <main>
            @yield('content')
        </main>
        
        {{-- Footer - Opsional --}}
        <footer class="text-center mt-10 p-4 text-pastel-dark/70 text-sm">
            &copy; {{ date('Y') }} POS Toko. All rights reserved.
        </footer>
    </div>
    
    <!-- Scripts Tambahan jika diperlukan -->
    @stack('scripts')

</body>
</html>