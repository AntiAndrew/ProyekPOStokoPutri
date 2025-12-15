<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Toko | @yield('title', 'Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2f3e4e',
                        primarySoft: '#3b4b5c',
                        primaryDark: '#1f2a36',
                        textDark: '#1e2933',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg,#1f2a36,#2f3e4e,#3b4b5c);
        }

        .app-container-barang {
            min-height: 100vh;
            padding: 1rem;
            background: transparent;
        }

        .header-ui {
            background: rgba(240,243,247,0.9);
            backdrop-filter: blur(8px);
            position: relative;
        }
    </style>
</head>

<body>

<div class="app-container-barang">

    <!-- HEADER -->
    <div class="header-ui p-4 rounded-lg shadow-md mb-6 sticky top-0 z-10">

        <!-- KIRI -->
        <div class="flex items-center space-x-4">
            <button onclick="history.back()"
                class="bg-primary text-white p-2 rounded-full shadow hover:bg-primaryDark">
                <i class="fas fa-arrow-left"></i>
            </button>

            <a href="{{ route('dashboard.index') }}"
               class="bg-primarySoft text-white p-2 rounded-full shadow hover:bg-primary">
                <i class="fas fa-house"></i>
            </a>
        </div>

        <!-- JUDUL TENGAH -->
        <h1 class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2
                   text-2xl font-bold text-textDark">
            @yield('title')
        </h1>

    </div>

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="text-center mt-10 p-4 text-white/80 text-sm">
        &copy; {{ date('Y') }} POS Toko. All rights reserved.
    </footer>

</div>

@stack('scripts')
</body>
</html>
