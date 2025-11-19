@extends('layouts.app') 

@section('title', 'Edit Barang: ' . $barang->nama_barang)

@section('content')
<div class="container form-page">
    {{-- ... Header UI ... --}}
    
    <h2 class="text-center">Edit Barang: {{ $barang->id_barang }}</h2>
    
    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
        @csrf
        @method('PUT') 
        
        {{-- ... Input ID Barang dan Nama Barang ... --}}
        
        <label for="harga_barang">Harga Barang (Rp.)</label>
        <input type="number" name="harga_barang" id="harga_barang" required min="0" value="{{ old('harga_barang', $barang->harga_barang) }}">
        
        <label for="jumlah_barang">Jumlah Stok</label>
        <input type="number" name="jumlah_barang" id="jumlah_barang" required min="0" value="{{ old('jumlah_barang', $barang->jumlah_barang) }}">

        <div class="form-btn-bottom">
            <a href="{{ route('barang.manage') }}" class="btn-cancel">Kembali</a>
            <button type="submit" class="btn-save">Perbarui</button>
            <button type="reset" class="btn-reset">Batal</button>
        </div>
    </form>
</div>
@endsection