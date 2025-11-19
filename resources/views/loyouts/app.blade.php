<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Menggunakan @yield('title') agar judul halaman bisa diubah per halaman --}}
    <title>@yield('title', 'POS Toko')</title>

    {{-- Link Bootstrap CSS (Wajib untuk styling tabel) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
          
    {{-- Link Font Awesome CSS (Wajib untuk ikon panah, rumah, dll.) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
</head>
<body>
    
    {{-- Tempat konten utama dari view lain yang memanggil @extends('layouts.app') --}}
    @yield('content') 

    {{-- Script JavaScript Bootstrap (Dibutuhkan untuk beberapa komponen interaktif) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>
            
    {{-- Jika ada script lain, tambahkan di sini --}}
    @stack('scripts')
</body>
</html>