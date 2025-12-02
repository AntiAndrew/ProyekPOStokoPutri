@extends('layouts.app')

@section('title', 'Menu Kelola Transaksi')

@section('content')

{{-- Define the custom color variables if not globally available --}}
<style>
:root {
    --pastel-light: #f1eae3ff; /* Corresponds to bg-[var(--bg-main)] */
    --pastel-accent: #f0b566ff; /* Corresponds to var(--color-accent) */
    --pastel-dark: #383E56; /* Corresponds to var(--color-dark); Teks dan Garis */
}
.bg-pastel-light { background-color: var(--pastel-light); }
.bg-pastel-accent\/70 { background-color: rgba(240, 181, 102, 0.7); }
.bg-pastel-accent\/90 { background-color: rgba(240, 181, 102, 0.9); }
.text-pastel-dark { color: var(--pastel-dark); }
.border-pastel-dark\/50 { border-color: rgba(56, 62, 86, 0.5); }
.menu-card {
    transition: all 0.3s ease;
    /* Memberikan sedikit glow pada hover */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.menu-card:hover {
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px); /* Efek sedikit terangkat */
}
.menu-card svg {
    transition: transform 0.2s;
}
.menu-card:hover svg {
    transform: scale(1.05);
}
</style>

<div class="menu-transaksi-container flex flex-col items-center justify-center p-4 sm:p-6 min-h-[85vh]">

    <div class="w-full max-w-4xl bg-pastel-light p-6 sm:p-8 rounded-2xl shadow-xl">

        {{-- Header Menu Samping (Kelola Transaksi) - Left-aligned over the menu grid --}}
        <div class="flex items-center justify-start mb-10 w-full">
            {{-- Spacer untuk menyesuaikan posisi dengan garis vertikal di bawah (hidden on mobile) --}}
            <div class="hidden sm:block w-0.5 mr-8 flex-shrink-0"></div>
            
            {{-- Menu Title Box --}}
            <div class="bg-pastel-accent/70 text-pastel-dark font-extrabold text-xl sm:text-2xl py-3 px-6 rounded-xl shadow-lg text-center tracking-wide max-w-sm">
                Kelola Transaksi
            </div>
        </div>

        {{-- Container Kotak Menu dengan Garis Pemisah Vertikal --}}
        {{-- Menggunakan items-start agar garis mulai dari atas menu --}}
        <div class="flex items-start space-x-0 sm:space-x-8">

            {{-- Garis Pemisah Vertikal di Sisi Kiri (Hidden on mobile, height h-72) --}}
            <div class="hidden sm:block w-0.5 bg-pastel-dark/30 h-72 mr-8 rounded-full flex-shrink-0"></div>

            {{-- Kotak Menu Utama (Grid 2x2) --}}
            <div class="flex-grow grid grid-cols-1 sm:grid-cols-2 gap-8 w-full">

                {{-- KOTAK 1: Input Transaksi --}}
                <a href="{{ route('transaksi.create') }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center border-b-4 border-pastel-dark/50 hover:border-b-8">
                    <svg class="mx-auto mb-3 w-16 h-16 text-pastel-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm11.25 3.75a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h3.75v2.25a.75.75 0 0 0 1.5 0v-2.25H18a.75.75 0 0 0 0-1.5h-3.75V9.75Z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold text-lg text-pastel-dark">Input Transaksi</span>
                </a>

                {{-- KOTAK 2: Edit Transaksi --}}
                <a href="{{ route('transaksi.manage', ['mode'=>'edit']) }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center border-b-4 border-pastel-dark/50 hover:border-b-8">
                    <svg class="mx-auto mb-3 w-16 h-16 text-pastel-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.18 1.18a2.625 2.625 0 0 0 3.712 3.712l1.18-1.18a2.625 2.625 0 0 0 0-3.712ZM19.513 8.118l-3.693 3.693L2.25 22.139V18.44L15.82 4.872l3.693 3.693Z" />
                    </svg>
                    <span class="font-bold text-lg text-pastel-dark">Edit Transaksi</span>
                </a>

                {{-- KOTAK 3: Hapus Transaksi (Menggunakan warna merah yang lebih lembut) --}}
                <a href="{{ route('transaksi.manage', ['mode'=>'delete']) }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center border-b-4 border-pastel-dark/50 hover:border-b-8">
                    <svg class="mx-auto mb-3 w-16 h-16 text-red-700/80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.846 48.846 0 0 0-1.123 7.518c.073.443.35.815.72.867 1.131.14 1.948.598 1.948 1.097 0 .499-.817.957-1.948 1.097-.37.052-.647.424-.72.866a48.847 48.847 0 0 1-1.123 7.518v.227c0 1.562-2.503 1.562-2.503 0V4.478c0-1.562 2.503-1.562 2.503 0Z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold text-lg text-pastel-dark">Hapus Transaksi</span>
                </a>

                {{-- KOTAK 4: Lihat Daftar Transaksi --}}
                <a href="{{ route('transaksi.index') }}" class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center border-b-4 border-pastel-dark/50 hover:border-b-8">
                    <svg class="mx-auto mb-3 w-16 h-16 text-pastel-dark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 5.25ZM3 11.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75ZM3 17.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold text-lg text-pastel-dark">Lihat Daftar Transaksi</span>
                </a>

            </div> {{-- End Grid 2x2 --}}
        </div> {{-- End flex row with separator --}}

        {{-- Logout Button --}}
        <div class="mt-12 w-full flex justify-start">
            <a href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form-transaksi').submit();"
            class="bg-white/80 hover:bg-white text-pastel-dark font-bold py-3 px-8 rounded-xl shadow-lg transition duration-200 hover:scale-[1.02] border border-pastel-dark/20">
            Logout
            </a>

            <form id="logout-form-transaksi" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

    </div> {{-- End max-w-4xl --}}

</div>
@endsection