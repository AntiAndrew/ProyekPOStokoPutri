@extends('layouts.app')

@section('title', 'Hapus Barang')

@section('content')
<div class="table-container">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert-error">
        {{ session('error') }}
    </div>
    @endif

    <table class="data-table">

        <thead>
        <tr>
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Nama</th>
            <th class="border px-4 py-2">Kategori</th>
            <th class="border px-4 py-2">Harga</th>
            <th class="border px-4 py-2">Jumlah</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
        </thead>

        <tbody>
        @foreach($data_barang as $item)
        <tr class="text-center hover:bg-gray-100">

            <td class="border px-2 py-1">{{ $item->id_barang }}</td>
            <td class="border px-2 py-1">{{ $item->nama_barang }}</td>
            <td class="border px-2 py-1">{{ $item->kategori }}</td>
            <td class="border px-2 py-1">Rp {{ number_format($item->harga_barang,0,',','.') }}</td>
            <td class="border px-2 py-1">{{ $item->jumlah_barang }}</td>

            <td class="border px-2 py-1">

                <form action="{{ route('barang.destroy', $item->id_barang) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                      style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-400 hover:bg-red-500 text-white px-3 py-1 rounded text-sm">
                        Hapus
                    </button>
                </form>

            </td>

        </tr>
        @endforeach
        </tbody>

    </table>

</div>

{{-- Tombol Aksi --}}
<div class="form-btn-bottom mt-10">
    <a href="{{ route('barang.menu') }}" class="btn-cancel">Kembali</a>
</div>

@endsection
