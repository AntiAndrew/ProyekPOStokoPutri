@extends('layouts.app')

@section('title', 'Hapus Barang')

@section('content')
<div class="table-container">

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
                    <button type="submit" class="text-red-600 hover:text-red-700">
                    <!-- Heroicon trash (kotak sampah) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v11a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm2 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 6zm4 0a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5z" clip-rule="evenodd" />
                    </svg>
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
