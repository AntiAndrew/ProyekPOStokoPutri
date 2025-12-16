@extends('layouts.dashboard')

@section('title', 'Edit Barang')

@section('content')

{{-- NOTIFIKASI --}}
@if(session('success'))
<div class="alert-auto-hide fixed top-5 left-1/2 -translate-x-1/2 z-50
            bg-emerald-600 text-white px-6 py-3 rounded-lg shadow-lg">
    ✅ {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert-auto-hide fixed top-5 left-1/2 -translate-x-1/2 z-50
            bg-rose-600 text-white px-6 py-3 rounded-lg shadow-lg">
    ⚠️ {{ session('error') }}
</div>
@endif

{{-- CARD UTAMA (SAMA DENGAN LIHAT DAFTAR BARANG) --}}
<div class="bg-white rounded-2xl shadow-xl p-8">

    {{-- JUDUL --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">✏️</span>
        <h2 class="text-2xl font-bold text-slate-800">
            Edit Barang
        </h2>
    </div>

    <hr class="mb-6 border-slate-300">

    {{-- TABEL DI TENGAH --}}
    <div class="flex justify-center">
        <div class="w-full max-w-5xl overflow-x-auto">

            <table class="w-full border-collapse rounded-xl overflow-hidden shadow">

                {{-- HEADER --}}
                <thead class="bg-slate-200 text-slate-800 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-right">Harga</th>
                        <th class="px-4 py-3 text-center">Jumlah</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- BODY --}}
                <tbody class="bg-white text-sm">
                    @foreach($data_barang as $item)
                    <tr class="border-t hover:bg-slate-100 transition">

                        <td class="px-4 py-3 font-medium">
                            {{ $item->id_barang }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $item->nama_barang }}
                        </td>

                        <td class="px-4 py-3">
                            {{ ucfirst($item->kategori) }}
                        </td>

                        <td class="px-4 py-3 text-right">
                            Rp {{ number_format($item->harga_barang,0,',','.') }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            {{ $item->jumlah_barang }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('barang.edit', $item->id_barang) }}"
                               class="inline-flex items-center gap-1
                                      text-amber-600 hover:text-amber-700
                                      font-semibold">
                                ✏️ Edit
                            </a>
                        </td>

                    </tr>
                    @endforeach
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
