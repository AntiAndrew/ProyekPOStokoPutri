@extends('layouts.dashboard')

@section('title', 'Edit Barang')

@section('content')
<div class="table-container">
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

                    <td class="border px-2 py-1 text-center">
                    <a href="{{ route('barang.edit', $item->id_barang) }}" class="text-yellow-600 hover:text-yellow-700">
                        <!-- Heroicon edit -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 010 2.828l-9.192 9.192a1 1 0 01-.464.263l-4 1a1 1 0 01-1.213-1.213l1-4a1 1 0 01.263-.464l9.192-9.192a2 2 0 012.828 0z" />
                        </svg>
                    </a>
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
        </form>
    </div>
</div>
@endsection
