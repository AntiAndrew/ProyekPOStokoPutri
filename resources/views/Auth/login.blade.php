<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Toko</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f0f4f8; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-2xl">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h2>
        <p class="text-center text-gray-600 mb-8">Masuk ke Dashboard</p>

        <!-- Tampilkan pesan error validasi (jika gagal login) -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg" role="alert">
                <p>{{ $errors->first('email') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
    <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" required
                       class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150">
            </div>

            <div class="text-sm text-right mt-2">
    <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
        Lupa password Anda?
    </a>
</div>

            <div class="flex items-center justify-between mb-4">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-150 shadow-md">
                    Login
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition duration-150">
                Registrasi di sini
            </a>
        </p>
    </div>
</body>
</html>
