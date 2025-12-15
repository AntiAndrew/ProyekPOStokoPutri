@extends('layouts.dhashboard')
@section('title','Input Transaksi')

@section('content')
<div class="form-page">
    <div class="form-container">
       

        {{-- Menampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
            @csrf
            
            {{-- ID Transaksi --}}
            <div class="form-group">
                <label for="id_transaksi">ID Transaksi</label>
                <input type="text" id="id_transaksi" name="id_transaksi" 
                       value="{{ $id_transaksi_baru ?? old('id_transaksi') }}" readonly>
            </div>
            
            {{-- Tanggal --}}
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" 
                       value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>
            
            {{-- Pegawai otomatis sesuai login --}}
            <div class="form-group">
                <label>Pegawai </label>
                <input type="text" value="{{ auth()->user()->name ?? 'Nama Pegawai Tidak Ditemukan' }}" readonly>
                <input type="hidden" name="id_pegawai" value="{{ auth()->id() }}">
            </div>

            <hr class="my-4">
            

            {{-- Input manual id_barang & nama_barang --}}
            <div class="form-group">
                <label for="id_barang">ID Barang</label>
                <input type="text" id="id_barang" name="id_barang" value="{{ old('id_barang') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
            </div>

            {{-- Harga & Jumlah --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="form-group">
                    <label for="harga_barang">Harga Satuan (Rp)</label>
                    <input type="number" id="harga_barang" name="harga_barang" 
                           value="{{ old('harga_barang',0) }}" min="0" required>
                </div>

                <div class="form-group">
                    <label for="jumlah_barang">Jumlah Barang</label>
                    <input type="number" id="jumlah_barang" name="jumlah_barang" 
                           value="{{ old('jumlah_barang',1) }}" min="1" required>
                </div>

                <div class="form-group">
                    <label for="total_harga_display">Total Harga</label>
                    <input type="text" id="total_harga_display" value="Rp 0" readonly>
                    <input type="hidden" name="total_harga" id="input_total_harga" value="0">
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="form-btn-bottom">
                <a href="{{ route('transaksi.menu') }}" class="btn-cancel">Kembali</a>
                <button type="submit" class="btn-save">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const inputHarga = document.getElementById('harga_barang');
    const inputJumlah = document.getElementById('jumlah_barang');
    const displayTotal = document.getElementById('total_harga_display');
    const inputTotal = document.getElementById('input_total_harga');

    function calculateTotal() {
        const harga = parseFloat(inputHarga.value) || 0;
        const jumlah = parseInt(inputJumlah.value) || 0;
        const total = harga * jumlah;
        displayTotal.value = 'Rp ' + total.toLocaleString('id-ID');
        inputTotal.value = total;
    }

    inputHarga.addEventListener('input', calculateTotal);
    inputJumlah.addEventListener('input', calculateTotal);

    // Hitung saat pertama kali halaman dimuat
    calculateTotal();

    // Cegah double submit
    document.getElementById('formTransaksi').addEventListener('submit', function(e){
        this.querySelector('button[type="submit"]').disabled = true;
    });
</script>
@endpush
@endsection
