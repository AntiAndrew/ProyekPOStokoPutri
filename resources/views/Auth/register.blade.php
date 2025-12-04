<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengatur font kustom serif */
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
            /* Efek shadow dan styling tombol SUBMIT */
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

    {{-- Container Form, dibuat ramping seperti desain --}}
    <div class="w-full max-w-sm mx-auto p-4 sm:p-6 text-center">

        {{-- Judul Halaman --}}
        <h1 class="text-4xl header-font text-center mb-10">Registrasi Admin</h1>

        {{-- Tampilkan Error Validasi Laravel --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 rounded-md text-left">
                <p class="font-bold">Peringatan! Registrasi Gagal:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" class="space-y-4">
            @csrf

            {{-- 1. MASUKAN NAMA --}}
            <div class="input-group text-left">
                <label for="name" class="block font-medium">Masukan Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Nama Lengkap"
                    class="mt-1 block w-full border-gray-400 rounded-lg shadow-sm p-3 border focus:ring-0 focus:border-blue-600">
            </div>

            {{-- 2. MASUKAN EMAIL --}}
            <div class="input-group text-left">
                <label for="email" class="block font-medium">Masukan Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Email"
                    class="mt-1 block w-full border-gray-400 rounded-lg shadow-sm p-3 border focus:ring-0 focus:border-blue-600">
            </div>

            {{-- 3. MASUKAN PASSWORD --}}
            <div class="input-group text-left">
                <label for="password" class="block font-medium">Masukan Password</label>
                <input type="password" id="password" name="password" required placeholder="Password"
                    class="mt-1 block w-full border-gray-400 rounded-lg shadow-sm p-3 border focus:ring-0 focus:border-blue-600">
            </div>

            {{-- 4. NOMOR TELEPON --}}
            <div class="input-group text-left">
                <label for="noTelepon" class="block font-medium">Nomor Telepon</label>
                <div class="relative mt-1 flex rounded-lg shadow-sm border border-gray-400">
                    {{-- Kode Negara (Mimik styling input dengan bendera) --}}
                    <span class="inline-flex items-center px-3 text-gray-500 rounded-l-lg bg-gray-50 border-r border-gray-400">
                        <span class="mr-1 inline-block flag-icon" role="img" aria-label="Indonesia">🇮🇩</span> +62
                    </span>
                    {{-- Input Nomor Telepon --}}
                    <input type="text" id="noTelepon" name="noTelepon" value="{{ old('noTelepon') }}" required
                        class="flex-1 block w-full rounded-r-lg p-3 focus:ring-0 focus:border-blue-600 border-none">
                </div>
            </div>

            {{-- 5. KONFIRMASI KEMBALI PASSWORD --}}
            <div class="input-group text-left">
                <label for="password_confirmation" class="block font-medium">Konfirmasi kembali Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Password"
                    class="mt-1 block w-full border-gray-400 rounded-lg shadow-sm p-3 border focus:ring-0 focus:border-blue-600">
            </div>
            
            {{-- TOMBOL SUBMIT --}}
            <div class="pt-6">
                 <button type="submit" class="submit-button py-3 px-8 border border-transparent rounded-lg text-lg font-medium text-white bg-blue-600 hover:bg-blue-600 w-auto mx-auto block">
                    SUBMIT
                </button>
            </div>
        </form>

        {{-- Link "Sudah punya akun?" --}}
        <p class="mt-6 text-center text-sm text-gray-700">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 underline">Masuk di sini</a>
        </p>
    </div>
</body>
</html>