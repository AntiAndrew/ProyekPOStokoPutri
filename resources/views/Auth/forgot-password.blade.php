<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Mengatur font kustom serif yang sama */
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap');

        /* Konfigurasi untuk warna background dan font */
        .custom-bg {
            /* Warna light yellowish-green (krem muda) */
            background-color: #f0f5e5; 
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
            /* Efek shadow dan styling tombol Kirim Link Reset */
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

        {{-- Judul Halaman --}}
        <h1 class="text-4xl header-font text-center mb-6">Lupa Password ?</h1>
        <p class="text-sm mb-8 text-gray-700">Masukan email anda untuk reset password</p>

        {{-- Tampilkan pesan status sesi --}}
        @if (session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-6 rounded-md text-left">
                {{ session('status') }}
            </div>
        @endif

        {{-- Tampilkan Error Validasi Laravel --}}
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-6 rounded-md text-left">
                <p class="font-bold">Peringatan! Gagal:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulir untuk mengirim link reset password --}}
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf
            
            {{-- 1. EMAIL --}}
            <div class="input-group text-left">
                <label for="email" class="block font-medium">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full border-gray-400 rounded-lg shadow-sm p-3 border focus:ring-0 focus:border-blue-600"
                    placeholder="Email">
            </div>
            
            {{-- TOMBOL KIRIM LINK RESET --}}
            <div class="pt-8">
                 <button type="submit" class="submit-button py-3 px-8 border border-transparent rounded-lg text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 w-auto mx-auto block">
                    Kirim Link Reset
                </button>
            </div>
        </form>
    </div>
</body>
</html>