@extends('layouts.dashboard')

@section('title', 'Menu Kelola Pegawai')

@section('content')

<div class="menu-pegawai-container flex flex-col items-center justify-center p-6 min-h-[85vh]">

    <div class="w-full max-w-4xl bg-pastel-light p-8 rounded-2xl shadow-xl">
        
        {{-- Header Menu Samping (Kelola Pegawai) --}}
        <div class="flex items-start mb-10">

            {{-- Menu Title Box --}}
            <div class="bg-pastel-accent/70 text-pastel-dark font-bold text-xl py-3 px-6 rounded-l-xl shadow-md border-l-4 border-pastel-dark/30">
                Kelola Pegawai
            </div>

        </div>

        {{-- Container Menu --}}
        <div class="flex flex-col md:flex-row items-start space-x-0 md:space-x-8">

            {{-- Garis Pemisah Vertikal --}}
            <div class="hidden md:block w-0.5 bg-pastel-dark/30 h-80 mr-8"></div>
            
            {{-- Kotak Menu --}}
            <div class="flex-grow grid grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- KOTAK 1: Tambah Pegawai --}}
                <a href="{{ route('pegawai.create') }}"
                    class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                        transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">
                    
                    {{-- Ikon SVG --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 9v6M21 12h-6M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>

                    <span class="font-semibold text-lg text-pastel-dark">Tambah Pegawai</span>
                </a>

                {{-- KOTAK 2: Lihat Daftar Pegawai --}}
                <a href="{{ route('pegawai.index') }}"
                    class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                        transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>

                    <span class="font-semibold text-lg text-pastel-dark">Daftar Pegawai</span>
                </a>

                {{-- KOTAK 3: Edit Pegawai --}}
                <a href="{{ route('pegawai.index') }}"
                    class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                        transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3l-8 8-4 1 1-4 8-8z" />
                    </svg>

                    <span class="font-semibold text-lg text-pastel-dark">Edit Pegawai</span>
                </a>

                {{-- KOTAK 4: Hapus Pegawai --}}
                <a href="{{ route('pegawai.index') }}"
                    class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                        transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m1-3H8l-1 1H5v2h14V5h-2l-1-1z" />
                    </svg>

                    <span class="font-semibold text-lg text-pastel-dark">Hapus Pegawai</span>
                </a>

                {{-- KOTAK 5: Cari Pegawai --}}
                <a href="{{ url('pegawai/search') }}"
                    class="menu-card bg-pastel-accent/90 p-6 rounded-xl shadow-xl hover:shadow-2xl
                        transition duration-300 transform hover:-translate-y-1 text-center border-b-4 border-pastel-dark/50">

                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 w-16 h-16 text-pastel-dark"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M5 11a6 6 0 1112 0 6 6 0 01-12 0z" />
                    </svg>

                    <span class="font-semibold text-lg text-pastel-dark">Cari Pegawai</span>
                </a>

            </div> {{-- End Kotak Menu Utama --}}
        </div> {{-- End flex row --}}

    </div>
</div>

@endsection
