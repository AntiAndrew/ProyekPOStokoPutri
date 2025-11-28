@extends('layouts.app') 

@section('title', 'Edit Barang: ' . $barang->nama_barang)

@section('content')
<div class="container mx-auto p-6 bg-white rounded shadow-md max-w-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit Barang: {{ $barang->id_barang }}</h2>

    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" 
                   class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Kategori</label>
            <input type="text" name="kategori" value="{{ $barang->kategori }}" 
                   class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Harga Barang</label>
            <input type="number" name="harga_barang" value="{{ $barang->harga_barang }}" 
                   class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Jumlah Barang</label>
            <input type="number" name="jumlah_barang" value="{{ $barang->jumlah_barang }}" 
                   class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Kembali</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection