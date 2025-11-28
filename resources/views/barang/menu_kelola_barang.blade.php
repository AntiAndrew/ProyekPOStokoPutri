@extends('layouts.app')

@section('title', 'Menu Kelola Barang')

@section('content')

<div class="menu-barang-container flex flex-col items-center justify-center p-6 min-h-[85vh]">

<div class="w-full max-w-4xl bg-pastel-light p-8 rounded-2xl shadow-xl">
    
    {{-- Header Menu Samping (Kelola Barang) dan Search Bar --}}
    <div class="flex items-start mb-10">
        {{-- Menu Title Box --}}
        <div class="bg-pastel-accent/70 text-pastel-dark font-bold text-xl py-3 px-6 rounded-l-xl shadow-md border-l-4 border-pastel-dark/30">
            Kelola Barang
        </div>
        
        {{-- Search Bar --}}
        <form action="{{ route('barang.cari') }}" method="GET" class="flex-grow ml-4">
        <div class="relative">
            <input type="text" name="q" placeholder="Cari barang..."
                class="w-full py-3 pl-12 pr-4 text-lg border-2 rounded-full">
            <span class="absolute left-3 top-1/2 -translate-y-1/2">🔍</span>
        </div>
    </form>

        {{-- Hapus icon My Account --}}
        {{-- <a href="#" class="ml-4 bg-blue-700 text-white font-bold p-3 rounded-full shadow-lg transition duration-150 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </a> --}}
    </div>

    
    {{-- Container Kotak Menu --}}
    <div class="flex flex-col md:flex-row items-start space-x-0 md:space-x-8">
        
        {{-- Garis Pemisah (Vertical Line) --}}
        <div class="hidden md:block w-0.5 bg-pastel-dark/30 h-80 mr-8"></div>

        {{-- Kotak-Kotak Menu Utama --}}
        <div class="flex-grow grid grid-cols-2 lg:grid-cols-3 gap-6">
           
            {{-- KOTAK 1: Input Barang --}}
            <a href="{{ route('barang.create') }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">
                <img src="{{ asset('images/input barang.png') }}" class="mx-auto mb-3 w-20 h-20" alt="Input Icon" class="mx-auto mb-3" onerror="this.onerror=null;this.src='https://placehold.co/100x100/FFD384/383E56?text=💻'">
                <span class="font-semibold text-lg text-pastel-dark">Input Barang</span>
            </a>

            {{-- KOTAK 2: Edit Barang --}}
            <a href="{{ route('barang.manage') }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">
                <img src="{{ asset('images/edit barang.png') }}" class="mx-auto mb-3 w-20 h-20" alt="Edit Icon" class="mx-auto mb-3" onerror="this.onerror=null;this.src='https://placehold.co/100x100/FFD384/383E56?text=🖥️'">
                <span class="font-semibold text-lg text-pastel-dark">Edit Barang</span>
            </a>

            {{-- KOTAK 3: Hapus Barang --}}
            <a href="{{ route('barang.manage') }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">
                <img src="{{ asset('images/hapus barang.png') }}" class="mx-auto mb-3 w-20 h-20" alt="Hapus Icon" class="mx-auto mb-3" onerror="this.onerror=null;this.src='https://placehold.co/100x100/FFD384/EF4444?text=❌'">
                <span class="font-semibold text-lg text-pastel-dark">Hapus Barang</span>
            </a>

            {{-- KOTAK 4: Cari Barang --}}
            <a href="{{ route('barang.cari') }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">
                <img src="{{ asset('images/cari barang.png') }}" class="mx-auto mb-3 w-20 h-20" alt="Cari Icon" class="mx-auto mb-3" onerror="this.onerror=null;this.src='https://placehold.co/100x100/FFD384/383E56?text=🔎'">
                <span class="font-semibold text-lg text-pastel-dark">Cari Barang</span>
            </a>

            {{-- KOTAK 5: Lihat Daftar Barang --}}
            <a href="{{ route('barang.index') }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">
                <img src="{{ asset('images/lihat daftar barang.png') }}" class="mx-auto mb-3 w-20 h-20" alt="Lihat Icon" class="mx-auto mb-3" onerror="this.onerror=null;this.src='https://placehold.co/100x100/FFD384/383E56?text=📋'">
                <span class="font-semibold text-lg text-pastel-dark">Lihat Daftar Barang</span>
            </a>

        </div> {{-- End Kotak Menu Utama --}}
    </div> {{-- End flex row --}}

    {{-- Logout Button --}}
    <div class="mt-12 w-full flex justify-start">
        <a href="#" 
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        class="bg-white/70 hover:bg-white text-pastel-dark font-bold py-3 px-8 rounded-xl shadow-lg transition duration-200">
        Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

</div> {{-- End max-w-4xl --}}

</div>
@endsection