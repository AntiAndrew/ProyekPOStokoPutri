@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container mx-auto p-6 max-w-lg bg-white shadow rounded">
    
     {{-- NOTIFIKASI --}}
    @if(session('success'))
    <div class="alert-success fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-4 py-2 bg-green-800 text-white rounded shadow">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert-error fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-4 py-2 bg-red-500 text-white rounded shadow">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block font-semibold">Kode Barang</label>
            <input type="text" value="{{ $barang->id_barang }}" 
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Nama Barang</label>
            <input type="text" name="nama_barang"
                   value="{{ $barang->nama_barang }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Kategori</label>
            <input type="text" name="kategori"
                   value="{{ $barang->kategori }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block font-semibold">Harga</label>
            <input type="number" name="harga_barang"
                   value="{{ $barang->harga_barang }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Jumlah</label>
            <input type="number" name="jumlah_barang"
                   value="{{ $barang->jumlah_barang }}"
                   class="w-full border p-2 rounded">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('barang.manage') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Kembali
            </a>

            <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection
