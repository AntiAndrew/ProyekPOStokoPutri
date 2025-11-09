//Halaman lihat daftar barang
@extends('layouts.app') 
@section('title', 'Lihat Daftar Barang')
@section('content')
<div class="container simple-list-page">
    {{-- ... Header UI ... --}}
    <h2 class="text-center">Lihat Daftar Barang</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Kode/ID</th>
                <th>Jumlah Stok</th>
                <th>Harga Barang (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_barang as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->id_barang }}</td>
                    <td>{{ $barang->jumlah_barang }}</td>
                    <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                </tr>
            @empty
                {{-- ... Empty message ... --}}
            @endforelse
        </tbody>
    </table>
    {{-- ... Footer ... --}}
</div>
@endsection