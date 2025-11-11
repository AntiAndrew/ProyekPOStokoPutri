@extends('layouts.app')

@section('title', 'Menu Kelola Transaksi')

@section('content')

<div class="menu-transaksi-container flex flex-col items-center justify-center p-6 min-h-[85vh]">

<div class="w-full max-w-4xl bg-pastel-light p-8 rounded-2xl shadow-xl">

    {{-- Header (Judul dan Search Bar) --}}
    <div class="flex items-start mb-10">
        {{-- Kotak Judul --}}
        <div class="bg-pastel-accent/70 text-pastel-dark font-bold text-xl py-3 px-6 rounded-l-xl shadow-md border-l-4 border-pastel-dark/30">
            Kelola Transaksi
        </div>

        {{-- Search Bar --}}
        <div class="flex-grow ml-4">
            <div class="relative">
                <input type="text" placeholder="Cari Transaksi..." 
                        class="w-full py-3 pl-12 pr-4 text-lg border-2 border-pastel-green rounded-full shadow-inner focus:outline-none focus:border-pastel-dark transition duration-200 bg-white/80">
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-pastel-dark">🔍</span>
            </div>
        </div>

        {{-- My Account (ikon profil kecil di kanan atas) --}}
        <a href="#" class="ml-4 bg-blue-700 text-white font-bold p-3 rounded-full shadow-lg transition duration-150 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                </path>
            </svg>
        </a>
    </div>

    {{-- Container Menu --}}
    <div class="flex flex-col md:flex-row items-start space-x-0 md:space-x-8">

        {{-- Garis Pemisah Vertikal --}}
        <div class="hidden md:block w-0.5 bg-pastel-dark/30 h-80 mr-8"></div>

        {{-- Kotak Menu --}}
        <div class="flex-grow grid grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- KOTAK 1: Tambah Transaksi --}}
            <a href="{{ route('transaksi.create') }}" 
               class="menu-card bg-green-300/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-green-700/50">
                <img src="https://placehold.co/100x100/86EFAC/14532D?text=➕" 
                     alt="Tambah" class="mx-auto mb-3">
                <span class="font-semibold text-lg text-green-900">Tambah Transaksi Baru</span>
            </a>

            {{-- KOTAK 2: Lihat Daftar Transaksi --}}
            <a href="{{ route('transaksi.index') }}" 
               class="menu-card bg-blue-300/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-blue-700/50">
                <img src="https://placehold.co/100x100/93C5FD/1E3A8A?text=📋" 
                     alt="Daftar" class="mx-auto mb-3">
                <span class="font-semibold text-lg text-blue-900">Lihat Daftar Transaksi</span>
            </a>

            {{-- KOTAK 3: Edit / Kelola Transaksi --}}
            <a href="{{ route('transaksi.index') }}" 
               class="menu-card bg-yellow-300/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-yellow-700/50">
                <img src="https://placehold.co/100x100/FDE68A/78350F?text=🖋️" 
                     alt="Edit" class="mx-auto mb-3">
                <span class="font-semibold text-lg text-yellow-900">Edit Transaksi</span>
            </a>

            {{-- KOTAK 4: Hapus Transaksi --}}
            <a href="{{ route('transaksi.index') }}" 
               class="menu-card bg-red-300/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-red-700/50">
                <img src="https://placehold.co/100x100/FCA5A5/7F1D1D?text=❌" 
                     alt="Hapus" class="mx-auto mb-3">
                <span class="font-semibold text-lg text-red-900">Hapus Transaksi</span>
            </a>

            {{-- KOTAK 5: Cari Transaksi --}}
            <a href="{{ route('transaksi.index') }}" 
               class="menu-card bg-purple-300/90 p-6 rounded-xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-purple-700/50">
                <img src="https://placehold.co/100x100/D8B4FE/581C87?text=🔎" 
                     alt="Cari" class="mx-auto mb-3">
                <span class="font-semibold text-lg text-purple-900">Cari Transaksi</span>
            </a>

        </div> {{-- end grid --}}
    </div>

    {{-- Tombol Logout --}}
    <div class="mt-12 w-full flex justify-start">
        <a href="{{ route('logout') }}" 
           class="bg-white/70 hover:bg-white text-pastel-dark font-bold py-3 px-8 rounded-xl shadow-lg transition duration-200">
            Logout
        </a>
    </div>

</div> {{-- end card container --}}

</div> {{-- end main container --}}

@endsection
