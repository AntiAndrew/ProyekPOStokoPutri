@extends('layouts.app') 

@section('title', $mode === 'edit' ? 'Edit Barang' : 'Hapus Barang')

@section('content')
<div class="form-page">
    <div class="form-container">
        <h2 class="page-title">{{ $mode === 'edit' ? 'Edit Barang' : 'Hapus Barang' }}</h2>
        
        {{-- Data Contoh (sesuai desain) --}}
        @php
            $sample_data = [
                (object)['id' => 1, 'id_barang' => 'A.01', 'nama_barang' => 'Mie Goreng', 'kategori' => 'Makanan', 'harga' => '3.000', 'jumlah' => '5 pack', 'satuan' => '2 Pack'],
                (object)['id' => 2, 'id_barang' => 'A.02', 'nama_barang' => 'Ember', 'kategori' => 'Alat rumah tangga', 'harga' => '7.000', 'jumlah' => '6 buah', 'satuan' => '1 Buah'],
                (object)['id' => 3, 'id_barang' => 'A.03', 'nama_barang' => 'Aqua gelas', 'kategori' => 'Minuman', 'harga' => '2.500', 'jumlah' => '3 pack', 'satuan' => '1 Dus'],
            ];
            // Dalam aplikasi nyata, gunakan $data_barang
            $data_list = $data_barang->count() > 0 ? $data_barang : collect($sample_data);
        @endphp

        <form action="#" method="POST" class="mt-8">
            {{-- Tampilan Edit Barang --}}
            @if ($mode === 'edit')
                <div class="edit-list-layout">
                    {{-- Header Kolom --}}
                    <div class="grid grid-cols-7 gap-4 mb-4 font-semibold text-pastel-dark/70 text-center">
                        <div>No</div>
                        <div>ID</div>
                        <div>Nama Barang</div>
                        <div>Kategori</div>
                        <div>Harga Barang</div>
                        <div>Jumlah</div>
                        <div>Aksi</div>
                    </div>
                    
                    {{-- Baris Data --}}
                    @foreach ($data_list as $item)
                    <div class="grid grid-cols-7 gap-4 items-center mb-3">
                        <div class="text-center bg-white/70 rounded-lg py-2">{{ $loop->iteration }}.</div>
                        <div class="text-center bg-white/70 rounded-lg py-2">{{ $item->id_barang }}</div>
                        <input type="text" value="{{ $item->nama_barang }}" class="input-inline bg-white/70">
                        <input type="text" value="{{ $item->kategori }}" class="input-inline bg-pastel-dark/30">
                        <input type="text" value="Rp.{{ number_format($item->harga, 0, ',', '.') }}/bungkus" class="input-inline bg-white/70">
                        <input type="text" value="{{ $item->jumlah }}" class="input-inline bg-pastel-dark/30">
                        <div class="text-center">
                            <button type="button" class="text-pastel-dark/70 hover:text-pastel-dark transition transform hover:scale-110">
                                <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </div>
                    </div>
                    @endforeach

                    {{-- Tombol Aksi --}}
                    <div class="form-btn-bottom mt-10">
                        <a href="{{ route('barang.menu') }}" class="btn-cancel">
                            Kembali
                        </a>
                        <button type="submit" class="btn-submit ml-auto">
                            Simpan
                        </button>
                    </div>

                </div>

            {{-- Tampilan Hapus Barang --}}
            @else
                <div class="edit-list-layout">
                    {{-- Header Kolom --}}
                    <div class="grid grid-cols-5 gap-4 mb-4 font-semibold text-pastel-dark/70 text-center">
                        <div>No</div>
                        <div>Nama Barang</div>
                        <div>Satuan Barang</div>
                        <div>ID Barang</div>
                        <div>Aksi</div>
                    </div>

                    {{-- Baris Data --}}
                    @foreach ($data_list as $item)
                    <div class="grid grid-cols-5 gap-4 items-center mb-3">
                        <div class="text-center bg-white/70 rounded-lg py-2">{{ $loop->iteration }}.</div>
                        <div class="text-center bg-pastel-dark/30 rounded-lg py-2">{{ $item->nama_barang }}</div>
                        <div class="text-center bg-white/70 rounded-lg py-2">{{ $item->satuan }}</div>
                        <div class="text-center bg-pastel-dark/30 rounded-lg py-2">{{ $item->id_barang }}</div>
                        <div class="text-center">
                            <button type="button" class="text-red-600 hover:text-red-800 transition transform hover:scale-110">
                                <svg class="w-6 h-6 inline-block" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a2 2 0 012 2v1h4a1 1 0 110 2h-1v10a2 2 0 01-2 2H8a2 2 0 01-2-2V7H5a1 1 0 110-2h4V4a2 2 0 012-2zM8 7h8v10h-8V7zm2 2v6h2V9h-2zm4 0v6h2V9h-2z"></path></svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                    
                    {{-- Paginasi Tiruan --}}
                    <div class="pagination-footer text-center mt-6 text-pastel-dark/80 col-span-5">
                        <p>Previous <span class="bg-pastel-accent p-2 rounded-full font-bold shadow-sm">1</span> Next</p>
                    </div>

                </div>
            @endif
        </form>
    </div>
</div>
@endsection