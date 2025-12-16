@extends('layouts.dashboard') 

@section('title', 'Input Barang')

@section('page-title', 'Input Barang')

@section('content')
@include('Pegawai.header')
<div class="min-h-screen flex justify-center items-start pt-16">
    <div class="w-full max-w-2xl bg-white/90 backdrop-blur-md p-10 rounded-2xl shadow-xl border border-white/30">
        
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            
            {{-- ID Barang --}}
            <div class="form-group mb-4">
                <label for="id_barang" class="font-semibold">ID Barang</label>
                <input type="text"
                    id="id_barang"
                    name="id_barang"
                    value="{{ old('id_barang') }}"
                    class="w-full p-3 border rounded-lg mt-1"
                    required>

                @error('id_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
         
            {{-- Nama Barang --}}
            <div class="form-group mb-4">
                <label for="nama_barang" class="font-semibold">Nama Barang</label>
                <input type="text"
                       id="nama_barang"
                       name="nama_barang"
                       value="{{ old('nama_barang') }}"
                       class="w-full p-3 border rounded-lg mt-1"
                       required>
            </div>
            
            {{-- Kategori --}}
            <div class="form-group mb-4">
                <label for="kategori" class="font-semibold">Kategori</label>
                <select id="kategori"
                        name="kategori"
                        class="w-full p-3 border rounded-lg mt-1"
                        required>
                    <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>
                        Pilih Kategori
                    </option>
                    @foreach (['Makanan','Minuman','ATK','Elektronik','Sembako','Kebutuhan Rumah','Kosmetik'] as $kat)
                        <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
                            {{ $kat }}
                        </option>
                    @endforeach
                </select>
            </div>
   
            {{-- Harga Barang --}}
            <div class="form-group mb-4">
                <label for="harga_barang" class="font-semibold">Harga Barang</label>
                <input type="number"
                       id="harga_barang"
                       name="harga_barang"
                       value="{{ old('harga_barang') }}"
                       class="w-full p-3 border rounded-lg mt-1"
                       min="0"
                       required>
            </div>
            
            {{-- Jumlah Barang --}}
            <div class="form-group mb-6">
                <label for="jumlah_barang" class="font-semibold">Jumlah Barang</label>
                <input type="number"
                       id="jumlah_barang"
                       name="jumlah_barang"
                       value="{{ old('jumlah_barang') }}"
                       class="w-full p-3 border rounded-lg mt-1"
                       min="0"
                       required>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between">
                <a href="{{ route('barang.menu') }}"
                   class="px-6 py-3 rounded-xl bg-gray-200 text-textDark font-semibold hover:bg-gray-300 transition">
                    Kembali
                </a>

                <button type="submit"
                        class="px-6 py-3 rounded-xl bg-primary text-white font-bold shadow-md hover:bg-primaryDark transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
