@extends('layouts.app')

@section('title', 'Daftar Pegawai')

@section('content')

<div class="p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Daftar Pegawai</h1>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
    <div class="alert-success fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 bg-green-600 text-white rounded-lg shadow-xl transition-all duration-300">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert-error fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 bg-red-600 text-white rounded-lg shadow-xl transition-all duration-300">
        {{ session('error') }}
    </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('pegawai.create') }}" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Pegawai Baru
        </a>
    </div>

    <div class="table-container bg-white shadow-lg rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 data-table">

            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pegawai</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
            @forelse($data_pegawai as $item)
            <tr class="hover:bg-gray-50">
                
                {{-- NOTE: Using 'idPegawai' based on your model configuration --}}
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->idPegawai }}</td> 
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->jabatan ?? 'N/A' }}</td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">

                    {{-- Form Delete Pegawai --}}
                    {{-- URL: pegawai/{idPegawai} | Method: DELETE --}}
                    <form action="{{ route('pegawai.destroy', $item->idPegawai) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus pegawai {{ $item->nama }} (ID: {{ $item->idPegawai }})?')"
                          class="inline-block">
                        @csrf
                        @method('DELETE')
                        
                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150 p-2 rounded-full hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <!-- Heroicon trash -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3.5a.5.5 0 000 1H4v11a2 2 0 002 2h8a2 2 0 002-2V5h.5a.5.5 0 000-1H15V3a1 1 0 00-1-1H6zm2 4a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7A.5.5 0 018 6zm4 0a.5.5 0 01.5.5v7a.5.5 0 01-1 0v-7a.5.5 0 01.5-.5z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                    Tidak ada data pegawai yang ditemukan.
                </td>
            </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-8 text-center">
        <a href="{{ route('pegawai.menu') }}" class="inline-block px-6 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Kembali ke Menu
        </a>
    </div>

</div>

@endsection