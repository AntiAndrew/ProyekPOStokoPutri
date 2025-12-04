<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengatur font kustom serif yang sama dengan halaman registrasi */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

        /* Konfigurasi untuk warna background dan font */
        .custom-bg {
            /* Warna light yellowish-green (krem muda) */
            background-color: #d7d7dfff; 
        }
        .header-font {
            font-family: 'Playfair Display', Georgia, serif;
            color: #3e3e3e; /* Warna teks gelap */
        }
        .input-group label {
            /* Menyesuaikan ukuran font label */
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 4px;
        }
        .submit-button {
            /* Efek shadow dan styling tombol Masuk */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }
        .submit-button:hover {
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="custom-bg flex items-center justify-center min-h-screen p-4">

    {{-- Container Form, dibuat ramping --}}
    <div class="w-full max-w-sm mx-auto p-4 sm:p-6 text-center">

        {{-- Icon User (menggunakan SVG sederhana) --}}
        <div class="mb-8 flex justify-center">
            <svg class="w-16 h-16 text-gray-800" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>

        {{-- Tampilkan Error Validasi Laravel --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 rounded-md text-left">
                <p class="font-bold">Peringatan! Login Gagal:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- 1. ID (Asumsi ini adalah username/email) --}}
            <div class="input-group text-left">
                <label for="email" class="block font-medium">Email</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ID"
                    class="mt-1 block w-full border-gray-400 rounded-lg shadow-sm p-3 border focus:ring-0 focus:border-blue-600">
            </div>

            {{-- 2. MASUKAN PASSWORD --}}
            <div class="input-group text-left">
                <label for="password" class="block font-medium">Masukan Password</label>
                <input type="password" id="password" name="password" required placeholder="Password"
                    class="mt-1 block w-full border-gray-400 rounded-lg shadow-sm p-3 border focus:ring-0 focus:border-blue-600">
            </div>

            {{-- Link Lupa Password dan Daftar --}}
            <div class="flex justify-between text-sm mt-2 pt-1">
                <span class="text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a></span>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Lupa password?</a>
            </div>
            
            {{-- TOMBOL MASUK --}}
            <div class="pt-8">
                 <button type="submit" class="submit-button py-3 px-8 border border-transparent rounded-lg text-lg font-medium text-white bg-blue-500 hover:bg-blue-600 w-auto mx-auto block">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>
</html>