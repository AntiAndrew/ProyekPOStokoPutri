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

        {{-- Hapus icon My Account --}}
        {{-- <a href="#" class="ml-4 bg-blue-700 text-white font-bold p-3 rounded-full shadow-lg transition duration-150 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </a> --}}
    </div>

    
    {{-- Container Kotak Menu --}}
    <div class="flex-grow grid grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- KOTAK 1: Input Barang --}}
        <a href="{{ route('barang.create') }}"
            class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">
            
            {{-- Ikon SVG --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 7l9-4 9 4-9 4-9-4zm0 7l9 4 9-4M3 7v7m18-7v7" />
            </svg>

            <span class="font-semibold text-lg text-pastel-dark">Input Barang</span>
        </a>

        {{-- KOTAK 2: Edit Barang --}}
        <a href="{{ route('barang.manage') }}"
            class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3l-8 8-4 1 1-4 8-8z" />
            </svg>

            <span class="font-semibold text-lg text-pastel-dark">Edit Barang</span>
        </a>

        {{-- KOTAK 3: Hapus Barang --}}
        <a href="{{ route('barang.hapus') }}"
            class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m1-3H8l-1 1H5v2h14V5h-2l-1-1z" />
            </svg>

            <span class="font-semibold text-lg text-pastel-dark">Hapus Barang</span>
        </a>

        {{-- KOTAK 4: Cari Barang --}}
        <a href="{{ route('barang.cari') }}"
            class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-4.35-4.35M5 11a6 6 0 1112 0 6 6 0 01-12 0z" />
            </svg>

            <span class="font-semibold text-lg text-pastel-dark">Cari Barang</span>
        </a>

        {{-- KOTAK 5: Lihat Daftar Barang --}}
        <a href="{{ route('barang.index') }}"
            class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h7" />
            </svg>

            <span class="font-semibold text-lg text-pastel-dark">Lihat Daftar Barang</span>
        </a>

        </div> {{-- End Kotak Menu Utama --}}
    </div> {{-- End flex row --}}

</div>
@endsection