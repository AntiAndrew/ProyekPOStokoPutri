@extends('layouts.dashboard')

@section('title', 'Input Barang')

@section('content')

<div class="bg-white rounded-2xl shadow-xl p-8 max-w-2xl mx-auto">

    {{-- JUDUL --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">➕</span>
        <h2 class="text-2xl font-bold text-slate-800">
            Input Barang
        </h2>
    </div>

    <hr class="mb-6 border-slate-300">

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        {{-- ID BARANG --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                ID Barang
            </label>
            <input type="text"
                   name="id_barang"
                   value="{{ old('id_barang') }}"
                   required
                   class="w-full px-4 py-2.5 border rounded-lg
                          focus:ring-2 focus:ring-slate-400">

            @error('id_barang')
                <p class="text-rose-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- NAMA BARANG --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                Nama Barang
            </label>
            <input type="text"
                   name="nama_barang"
                   value="{{ old('nama_barang') }}"
                   required
                   class="w-full px-4 py-2.5 border rounded-lg
                          focus:ring-2 focus:ring-slate-400">
        </div>

        {{-- KATEGORI --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                Kategori
            </label>
            <select name="kategori"
                    required
                    class="w-full px-4 py-2.5 border rounded-lg
                           focus:ring-2 focus:ring-slate-400">
                <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>
                    Pilih Kategori
                </option>
                @foreach (['Makanan','Minuman','ATK','Elektronik','Sembako','Kebutuhan Rumah','Kosmetik'] as $kat)
                    <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
                        {{ $kat }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- HARGA --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                Harga Barang
            </label>
            <input type="number"
                   name="harga_barang"
                   value="{{ old('harga_barang') }}"
                   min="0"
                   required
                   class="w-full px-4 py-2.5 border rounded-lg
                          focus:ring-2 focus:ring-slate-400">
        </div>

        {{-- JUMLAH --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                Jumlah Barang
            </label>
            <input type="number"
                   name="jumlah_barang"
                   value="{{ old('jumlah_barang') }}"
                   min="0"
                   required
                   class="w-full px-4 py-2.5 border rounded-lg
                          focus:ring-2 focus:ring-slate-400">
        </div>

        {{-- TOMBOL --}}
        <div class="flex justify-between">
            <a href="{{ route('barang.menu') }}"
               class="bg-slate-700 hover:bg-slate-800
                       text-white px-6 py-2.5 rounded-lg shadow font-semibold">
                Kembali
            </a>

            <button type="submit"
                class="bg-slate-700 hover:bg-slate-800
                       text-white px-6 py-2.5 rounded-lg shadow font-semibold">
                Simpan
            </button>
        </div>

    </form>
</div>

@endsection
