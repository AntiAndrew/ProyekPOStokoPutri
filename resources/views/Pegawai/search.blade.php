@extends('layouts.app')

@section('title', 'Cari Pegawai')

@section('content')
<div class="container mx-auto py-8">

    {{-- CARD FORM --}}
    <div class="bg-gray-50 rounded-2xl p-6 shadow-md border border-gray-100 mb-8">

        <form action="{{ route('pegawai.cari') }}" method="GET"
              class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- INPUT KEYWORD --}}
            <div>
                <label class="text-sm font-medium text-gray-700">ID / Nama / Email</label>
                <input type="text"
                       name="keyword"
                       value="{{ request('keyword') }}"
                       placeholder="Input ID, Nama, atau Email Pegawai"
                       class="mt-1 w-full px-4 py-2.5 border rounded-xl shadow-sm focus:ring-2 focus:ring-gray-300">
            </div>

            {{-- FILTER JENIS KELAMIN --}}
            <div>
                <label class="text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin"
                        class="mt-1 w-full px-4 py-2.5 border rounded-xl shadow-sm focus:ring-2 focus:ring-gray-300">
                    <option value="">Semua Jenis Kelamin</option>
                    @if(isset($jenis_kelamin) && $jenis_kelamin->count())
                        @foreach($jenis_kelamin as $jk)
                            <option value="{{ $jk }}" {{ request('jenis_kelamin') == $jk ? 'selected' : '' }}>{{ $jk }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="flex gap-3 items-end">
                <button type="submit"
                        class="bg-gray-700 hover:bg-gray-600 text-white w-full px-6 py-2.5 rounded-xl shadow">
                    Cari
                </button>

                <div class="form-btn-bottom mt-10">
                    <a href="{{ route('pegawai.index') }}" class="btn-cancel text-gray-700 hover:text-gray-900">
                        Kembali
                    </a>
                </div>
            </div>

        </form>
    </div>

    {{-- Tampilkan tabel hanya jika ada input pencarian atau filter --}}
    @if(request('keyword') || request('jenis_kelamin'))
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100 mt-6">
            
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-700 text-white text-center">
                    <tr>
                        <th class="px-4 py-3">ID Pegawai</th>
                        <th class="px-4 py-3">Nama Pegawai</th>
                        <th class="px-4 py-3">Jenis Kelamin</th>
                        <th class="px-4 py-3">Umur</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($hasil_pencarian as $p)
                        <tr class="text-center border-t hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $p->idPegawai }}</td>
                            <td class="px-4 py-3 font-semibold">{{ $p->namaPegawai }}</td>
                            <td class="px-4 py-3">{{ $p->jenisKelamin }}</td>
                            <td class="px-4 py-3">{{ $p->umur }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-gray-500 text-center italic">
                                Pegawai tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

            <div class="px-4 py-3">
                {{ $hasil_pencarian->links() }}
            </div>

        </div>
    @endif

</div>
@endsection
