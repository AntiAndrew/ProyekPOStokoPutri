@extends('layouts.dashboard')

@section('title', 'Cari Barang')

@section('content')
<div class="container mx-auto py-8">

    {{-- CARD FORM --}}
    <div class="bg-blue-50 rounded-2xl p-6 shadow-md border border-blue-100 mb-8">

        <form action="{{ route('barang.cari') }}" method="GET"
            class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- INPUT KEYWORD --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Kode / Nama Barang</label>
                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Input ID Atau Nama Barang"
                       class="mt-1 w-full px-4 py-2.5 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-300">
            </div>

            {{-- FILTER KATEGORI --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Kategori</label>
                <select name="Kategori"
                        class="mt-1 w-full px-4 py-2.5 border rounded-xl shadow-sm focus:ring-2 focus:ring-blue-300">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                            {{ ucfirst($kat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="flex gap-3 items-end">
                <button type="submit"
                        class="bg-blue-400 hover:bg-blue-300 text-white w-full px-6 py-2.5 rounded-xl shadow">
                    Cari
                </button>

                <div class="form-btn-bottom mt-10">
                    <a href="{{ route('barang.menu') }}" class="btn-cancel">Kembali</a>
                </div>
        </form>
    </div>

           {{-- Tampilkan tabel hanya jika ada input pencarian --}}
           @if(request('q') || request('kategori'))
           <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 mt-6">
            
           <table class="w-full text-sm border-collapse">
            <thead class="bg-blue-400 text-white text-center">
            <tr>
                <th class="px-4 py-3">Kode / ID</th>
                <th class="px-4 py-3">Nama Barang</th>
                <th class="px-4 py-3">Kategori</th>
                <th class="px-4 py-3">Jumlah</th>
                <th class="px-4 py-3">Harga</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($hasil_pencarian as $item)
            <tr class="text-center border-t hover:bg-blue-50 transition">
                <td class="px-4 py-3">{{ $item->id_barang }}</td>
                <td class="px-4 py-3 font-semibold">{{ $item->nama_barang }}</td>
                <td class="px-4 py-3">{{ ucfirst($item->kategori) }}</td>
                <td class="px-4 py-3">{{ $item->jumlah_barang }}</td>
                <td class="px-4 py-3">
                    Rp {{ number_format($item->harga_barang, 0, ',', '.') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-8 text-gray-500 text-center italic">
                    Barang tidak ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>
@endif
@endsection
