@extends('layouts.dashboard') 

@section('title', 'Input Barang')

@section('content')
<div class="form-page">
    <div class="form-container">
        
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            
            {{-- ID Barang --}}
            <div class="form-group">
                <label for="id_barang">ID Barang</label>
                <input type="text" id="id_barang" name="id_barang" required>
            </div>
            
            {{-- Nama Barang --}}
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" required>
            </div>
            
            {{-- Kategori --}}
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" required> 
            </div>
            
            {{-- Harga Barang --}}
            <div class="form-group">
                <label for="harga_barang">Harga Barang</label>
                <input type="text" id="harga_barang" name="harga_barang" required>
            </div>
            
            {{-- Jumlah Barang --}}
            <div class="form-group">
                <label for="jumlah_barang">Jumlah Barang</label>
                <input type="text" id="jumlah_barang" name="jumlah_barang" required>
            </div>

            {{-- Tombol Aksi --}}
            <div class="form-btn-bottom mt-8">
                <a href="{{ route('barang.menu') }}" class="btn-cancel">Kembali</a>
                <button type="submit" class="bg-yellow-200 text-pastel-dark font-bold py-3 px-6 rounded-xl shadow-md hover:bg-yellow-400 transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
