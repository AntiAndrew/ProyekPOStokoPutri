@extends('layouts.dashboard')

@section('title', 'Menu Kelola Transaksi')

@section('content')

{{-- Define the custom color variables if not globally available --}}
<style>
:root {
    --pastel-light: #e4f5e8ff; /* Corresponds to bg-[var(--bg-main)] */
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
            {{-- Tinggi h-72 mungkin perlu disesuaikan karena tombol logout dihapus --}}
            <div class="hidden sm:block w-0.5 bg-pastel-dark/30 h-72 mr-8 rounded-full flex-shrink-0"></div>

            {{-- Kotak Menu Utama (Grid 2x2) --}}
            <div class="flex-grow grid grid-cols-1 sm:grid-cols-2 gap-8 w-full">
{{-- KOTAK 1: Input Transaksi --}}
<a href="{{ route('transaksi.create') }}" 
   class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center 
          border-b-4 border-pastel-dark/50 hover:border-b-8">

    {{-- Ikon: Plus (Tambah) --}}
    <svg class="mx-auto mb-3 w-16 h-16 text-pastel-dark" 
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-width="2" 
              d="M12 4v16m8-8H4"/>
    </svg>

    <span class="font-bold text-lg text-pastel-dark">Input Transaksi</span>
</a>

{{-- KOTAK 2: Edit Transaksi --}}
<a href="{{ route('transaksi.manage', ['mode'=>'edit']) }}" 
   class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center 
          border-b-4 border-pastel-dark/50 hover:border-b-8">

    {{-- Ikon: Pencil (Edit) --}}
    <svg class="mx-auto mb-3 w-16 h-16 text-pastel-dark" 
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-width="2" 
              d="M12 20h9M16.5 3.5l4 4L7 21H3v-4L16.5 3.5z"/>
    </svg>

    <span class="font-bold text-lg text-pastel-dark">Edit Transaksi</span>
</a>

{{-- KOTAK 3: Hapus Transaksi --}}
<a href="{{ route('transaksi.manage', ['mode'=>'delete']) }}" 
   class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center 
          border-b-4 border-pastel-dark/50 hover:border-b-8">

    {{-- Ikon: Trash (Tempat Sampah) --}}
    <svg class="mx-auto mb-3 w-16 h-16 text-pastel-dark" 
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-width="2" 
              d="M3 6h18M8 6V4h8v2M10 11v6m4-6v6M6 6l1 14h10l1-14"/>
    </svg>

    <span class="font-bold text-lg text-pastel-dark">Hapus Transaksi</span>
</a>

{{-- KOTAK 4: Lihat Daftar Transaksi --}}
<a href="{{ route('transaksi.index') }}" 
   class="menu-card bg-pastel-accent/90 p-6 rounded-xl text-center 
          border-b-4 border-pastel-dark/50 hover:border-b-8">

    {{-- Ikon: List --}}
    <svg class="mx-auto mb-3 w-16 h-16 text-pastel-dark" 
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-width="2" 
              d="M4 6h16M4 12h16M4 18h16"/>
    </svg>

    <span class="font-bold text-lg text-pastel-dark">Lihat Daftar Transaksi</span>
</a>

            </div> {{-- End Grid 2x2 --}}
        </div> {{-- End flex row with separator --}}

        {{-- <div class="mt-12 w-full flex justify-start"> (Bagian ini sekarang kosong karena Logout dihapus)</div> --}}

    </div> {{-- End max-w-4xl --}}

</div>
@endsection