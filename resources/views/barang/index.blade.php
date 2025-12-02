@extends('layouts.app') 
@section('title', 'Lihat Daftar Barang')
@section('content')
<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>Kode/ID</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah Stok</th>
                <th>Harga Barang (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data_barang as $barang)
                <tr>
                    <td>{{ $barang->id_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori }}</td>
                    <td>{{ $barang->jumlah_barang }}</td>
                    <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
 {{-- Tombol Aksi --}}
            <div class="form-btn-bottom mt-10">
                <a href="{{ route('barang.menu') }}" class="btn-cancel">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection