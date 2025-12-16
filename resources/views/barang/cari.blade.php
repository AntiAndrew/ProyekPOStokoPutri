@extends('layouts.dashboard')

@section('title', 'Cari Barang')

@section('content')

<div class="bg-white rounded-2xl shadow-xl p-8">

    {{-- JUDUL --}}
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">🔍</span>
        <h2 class="text-2xl font-bold text-slate-800">
            Cari Barang
        </h2>
    </div>

    <hr class="mb-6 border-slate-300">

    {{-- FORM CARI --}}
    <form action="{{ route('barang.cari') }}" method="GET"
          class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        {{-- KODE / NAMA --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">
                ID / Nama Barang
            </label>
            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Contoh: A01 / Mie"
                   class="w-full px-4 py-2.5 border rounded-lg
                          focus:ring-2 focus:ring-slate-400">
        </div>

        {{-- KATEGORI --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Kategori
                </label>
                <select name="kategori"
                    class="w-full px-4 py-2.5 border rounded-lg
                        focus:ring-2 focus:ring-slate-400">
                    <option value="">Semua Kategori</option>

                    @foreach ($kategori_list as $kat)
                        <option value="{{ $kat }}"
                            {{ request('kategori') === $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>

        {{-- BUTTON --}}
        <div class="flex items-end gap-3">
            <button type="submit"
                class="bg-slate-700 hover:bg-slate-800
                       text-white w-full px-6 py-2.5 rounded-lg shadow">
                Cari
            </button>

            <a href="{{ route('barang.menu') }}"
                class="bg-slate-400 hover:bg-slate-500
                      text-white px-6 py-2.5 rounded-lg shadow">
                Kembali
            </a>
        </div>
    </form>

    {{-- HASIL --}}
    @if(request('q') || request('kategori'))
    <div class="flex justify-center">
        <div class="w-full max-w-5xl overflow-x-auto">

            <table class="w-full border-collapse rounded-xl overflow-hidden shadow">

                <thead class="bg-slate-200 text-slate-800 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID Barang</th>
                        <th class="px-4 py-3 text-left">Nama Barang</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-center">Jumlah Barang</th>
                        <th class="px-4 py-3 text-right">Harga</th>
                    </tr>
                </thead>

                <tbody class="bg-white text-sm">
                    @forelse ($hasil_pencarian as $item)
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
                        <td class="px-4 py-3 text-center">
                            {{ $item->jumlah_barang }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            Rp {{ number_format($item->harga_barang, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5"
                            class="py-8 text-center text-slate-500 italic">
                            Barang tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>
    @endif

</div>

@endsection
