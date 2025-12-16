@extends('layouts.dashboard')

@section('title', 'Edit Barang')

@section('content')

{{-- NOTIFIKASI --}}
@if(session('success'))
<div class="fixed top-5 left-1/2 -translate-x-1/2 z-50
            bg-emerald-600 text-white px-6 py-3 rounded-lg shadow-lg
            flex items-center gap-2">
    <span class="text-lg">✅</span>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="fixed top-5 left-1/2 -translate-x-1/2 z-50
            bg-rose-600 text-white px-6 py-3 rounded-lg shadow-lg
            flex items-center gap-2">
    <span class="text-lg">⚠️</span>
    <span>{{ session('error') }}</span>
</div>
@endif


{{-- CARD UTAMA (SAMA PERSIS DENGAN LIHAT DAFTAR BARANG) --}}
<div class="bg-white rounded-2xl shadow-xl p-8 max-w-3xl mx-auto">

    {{-- JUDUL --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">✏️</span>
        <h2 class="text-2xl font-bold text-slate-800">
            Edit Data Barang
        </h2>
    </div>

    <hr class="mb-6 border-slate-300">

    {{-- FORM --}}
    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST"
          class="grid grid-cols-1 gap-5 max-w-xl mx-auto">
        @csrf
        @method('PUT')

        {{-- ID BARANG --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                ID Barang
            </label>
            <input type="text"
                name="id_barang"
                value="{{ $barang->id_barang }}"
                readonly
                class="w-full px-4 py-2 rounded-lg border
                        bg-gray-100 cursor-not-allowed
                        focus:ring-2 focus:ring-slate-500 focus:outline-none">
        </div>

        {{-- NAMA BARANG --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                Nama Barang
            </label>
            <input type="text"
                   name="nama_barang"
                   value="{{ $barang->nama_barang }}"
                   class="w-full px-4 py-2 rounded-lg border
                          focus:ring-2 focus:ring-slate-500 focus:outline-none">
        </div>

        {{-- KATEGORI --}}
        <div>
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
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                Harga (Rp)
            </label>
            <input type="number"
                   name="harga_barang"
                   value="{{ $barang->harga_barang }}"
                   class="w-full px-4 py-2 rounded-lg border
                          focus:ring-2 focus:ring-slate-500 focus:outline-none">
        </div>

        {{-- JUMLAH --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                Jumlah Barang
            </label>
            <input type="number"
                   name="jumlah_barang"
                   value="{{ $barang->jumlah_barang }}"
                   class="w-full px-4 py-2 rounded-lg border
                          focus:ring-2 focus:ring-slate-500 focus:outline-none">
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-between pt-6">
            <a href="{{ route('barang.manage') }}"
               class="px-6 py-2 bg-slate-800 hover:bg-slate-900
                           text-white rounded-lg shadow">
                Kembali
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-slate-800 hover:bg-slate-900
                           text-white rounded-lg shadow">
                Simpan
            </button>
        </div>

    </form>
</div>

@endsection
