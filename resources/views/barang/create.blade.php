@extends('layouts.app') 

@section('title', 'Input Barang')

@section('content')
<div class="form-page">
    <div class="form-container">
        <h2 class="page-title">Input Barang</h2>
        
        <form action="#" method="POST">
            @csrf
            
            {{-- ID Barang --}}
            <div class="form-group">
                <label for="id_barang">ID Barang</label>
                <input type="text" id="id_barang" name="id_barang" value="{{ $nextId ?? 'A.01' }}" readonly>
            </div>
            
            {{-- Nama Barang --}}
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="Mie Goreng" required>
            </div>
            
            {{-- Kategori --}}
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="makanan" selected>Makanan</option>
                    <option value="minuman">Minuman</option>
                    <option value="alat_rumah_tangga">Alat rumah tangga</option>
                </select>
            </div>
            
            {{-- Harga Barang --}}
            <div class="form-group">
                <label for="harga_barang">Harga Barang</label>
                {{-- Di desain terlihat sebagai teks biasa, tapi ini harusnya input --}}
                <input type="text" id="harga_barang" name="harga_barang" value="Rp.3.000" required>
            </div>
            
            {{-- Jumlah Barang --}}
            <div class="form-group">
                <label for="jumlah_barang">Jumlah Barang</label>
                <input type="text" id="jumlah_barang" name="jumlah_barang" value="1 bungkus" required>
            </div>

            {{-- Tombol Aksi --}}
            <div class="form-btn-bottom mt-10">
                <a href="{{ route('barang.menu') }}" class="btn-cancel">
                    Kembali
                </a>
                <button type="button" class="btn-cancel">
                    Batal
                </button>
                <button type="submit" class="btn-submit">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection