@extends('layouts.dashboard')

@section('title', 'Menu Kelola Transaksi')

@section('content')

<style>
:root {
    --pastel-light: #ffffff;
    --pastel-accent: #f4b763;
    --pastel-dark: #364056;
}

/* Card */
.menu-card {
    transition: all .25s ease;
    box-shadow: 0 6px 14px rgba(60, 28, 28, 0.08);
    border-radius: 18px;
    position: relative;
    z-index: 2;
}
.menu-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}
.menu-card img {
    transition: .25s ease;
}
.menu-card:hover img {
    transform: scale(1.12);
}

/* Header image */
.header-image {
    width: 200px;
    z-index: 2;
}
</style>


<div class="min-h-[90vh] p-6 flex items-center justify-center bg-white">

    {{-- CARD PUTIH --}}
    <div class="w-full max-w-4xl bg-white p-10 rounded-3xl shadow-2xl border border-[#d6dfda]">

        {{-- TITLE --}}
        <h2 class="text-center text-3xl font-extrabold text-[var(--pastel-dark)] tracking-wide mb-10">
           Kelola Transaksi
        </h2>

        {{-- GRID MENU --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">

           {{-- INPUT --}}
        <a href="{{ route('transaksi.create') }}"
        class="menu-card bg-[var(--pastel-accent)]/90 p-8 text-center border-b-8 border-[var(--pastel-dark)]/40">
            <img src="https://cdn-icons-png.flaticon.com/512/748/748113.png"
     class="w-20 h-20 mx-auto mb-3 drop-shadow-lg">
            <div class="text-xl font-bold text-[var(--pastel-dark)]">Input Transaksi</div>
        </a>

            {{-- EDIT --}}
            <a href="{{ route('transaksi.manage',['mode'=>'edit']) }}"
            class="menu-card bg-[var(--pastel-accent)]/90 p-8 text-center border-b-8 border-[var(--pastel-dark)]/40">
                <img src="https://cdn-icons-png.flaticon.com/512/84/84380.png" 
                     class="w-20 h-20 mx-auto mb-4 drop-shadow-lg">
                <div class="text-xl font-bold text-[var(--pastel-dark)]">Edit Transaksi</div>
            </a>

            {{-- DELETE --}}
            <a href="{{ route('transaksi.manage',['mode'=>'delete']) }}"
            class="menu-card bg-[var(--pastel-accent)]/90 p-8 text-center border-b-8 border-[var(--pastel-dark)]/40">
                <img src="https://cdn-icons-png.flaticon.com/512/3096/3096673.png" 
                     class="w-20 h-20 mx-auto mb-4 drop-shadow-lg">
                <div class="text-xl font-bold text-[var(--pastel-dark)]">Hapus Transaksi</div>
            </a>

            {{-- LIST --}}
            <a href="{{ route('transaksi.index') }}"
            class="menu-card bg-[var(--pastel-accent)]/90 p-8 text-center border-b-8 border-[var(--pastel-dark)]/40">
                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828859.png" 
                     class="w-20 h-20 mx-auto mb-4 drop-shadow-lg">
                <div class="text-xl font-bold text-[var(--pastel-dark)]">Lihat Daftar Transaksi</div>
            </a>

        </div>
    </div>
</div>

@endsection
