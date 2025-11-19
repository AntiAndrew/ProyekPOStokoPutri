@extends('layouts.app') 

@section('title', 'Cari Barang')

@section('content')
<div class="form-page">
    <div class="form-container">
        
        {{-- Area Input Pencarian --}}
        <div class="search-area bg-blue-300/50 rounded-lg p-6 mb-8 shadow-md">
            <h2 class="text-2xl font-semibold text-pastel-dark mb-4 border-b pb-2">
                <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                Cari Barang</h2>
            <div class="relative">
                <input type="text" placeholder="Masukkan Kode/Nama Barang: A.01" 
                       class="w-full py-3 px-4 text-lg border-2 border-blue-400 rounded-lg shadow-inner focus:outline-none focus:border-blue-600 transition duration-200 bg-white/80" 
                       value="A.01"
                       id="search_query">
            </div>
            <button type="button" class="hidden">Cari</button> {{-- Tombol submit tersembunyi, karena desain mengandalkan enter/auto-search --}}
        </div>

        {{-- Kategori Filter --}}
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach ($kategori as $kat)
                <span class="category-chip {{ $kat === 'Perlengkapan Kos' ? 'category-active' : '' }}">
                    {{ $kat }}
                </span>
            @endforeach
        </div>

        {{-- Hasil Pencarian --}}
        <h3 class="text-2xl font-semibold text-pastel-dark mb-4 border-b pb-2">
            <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            Hasil Pencarian
        </h3>
        
        @if (count($hasil_pencarian) > 0)
            <div class="search-results space-y-4">
                @foreach ($hasil_pencarian as $result)
                <div class="result-box bg-white/80 p-4 rounded-lg shadow-md border-l-4 border-pastel-green hover:shadow-lg transition duration-200">
                    <span class="font-bold text-lg text-pastel-dark">{{ $result->id }}:</span> 
                    <span class="text-lg text-gray-700">{{ $result->nama }}</span>
                </div>
                @endforeach
            </div>
        @else
            <div class="p-4 text-center text-pastel-dark/70 bg-pastel-accent/30 rounded-lg">
                <p>Tidak ditemukan hasil untuk pencarian Anda.</p>
            </div>
        @endif

    </div>
</div>
@endsection