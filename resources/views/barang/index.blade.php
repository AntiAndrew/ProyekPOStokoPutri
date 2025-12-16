@extends('layouts.dashboard')

@section('title', 'Daftar Barang')

@section('content')

{{-- CARD UTAMA --}}
<div class="bg-white rounded-2xl shadow-xl p-8">

    {{-- JUDUL --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">📦</span>
        <h2 class="text-2xl font-bold text-slate-800">
            Daftar Barang
        </h2>
    </div>

    <hr class="mb-6 border-slate-300">

    {{-- TABEL --}}
    <div class="flex justify-center">
        <div class="w-full max-w-5xl overflow-x-auto">

            <table class="w-full border-collapse rounded-xl overflow-hidden shadow">

                {{-- HEADER --}}
                <thead class="bg-slate-200 text-slate-800 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID Barang</th>
                        <th class="px-4 py-3 text-left">Nama Barang</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-center">Jumlah Barang</th>
                        <th class="px-4 py-3 text-right">Harga Barang (Rp)</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="bg-white text-sm">
                    @forelse ($data_barang as $barang)
                        <tr class="border-t hover:bg-slate-100 transition">
                            <td class="px-4 py-3 font-medium">
                                {{ $barang->id_barang }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $barang->nama_barang }}
                            </td>
                            <td class="px-4 py-3">
                                {{ ucfirst($barang->kategori) }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                {{ $barang->jumlah_barang }}
                            </td>
                            <td class="px-4 py-3 text-right font-semibold">
                                Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-4 py-8 text-center text-gray-500 italic">
                                Belum ada data barang.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    {{-- TOMBOL --}}
    <div class="mt-8">
        <a href="{{ route('barang.menu') }}"
           class="inline-block bg-slate-700 hover:bg-slate-800
                  text-white px-6 py-2 rounded-lg shadow">
            Kembali
        </a>
    </div>

</div>

@endsection
