@extends('layouts.dhashboard')
@section('title','Input Transaksi')

@section('content')
<style>
/* 🎨 Gaya CSS untuk Halaman Input Transaksi (Biru-Ungu) */

/* Latar belakang halaman kembali ke warna biru-ungu */
.form-page {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
   
}

/* Container form dibuat lebih terang agar mudah dibaca */
.form-container {
    background-color: #f0f0ff; /* Latar belakang form lebih terang */
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 600px;
}

/* Style label dan input */
.form-group label {
    font-weight: bold;
    color: #333; /* Warna teks lebih gelap */
}
.form-group input {
    width: 100%;
    padding: 8px 12px;
    margin-top: 4px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Tombol Simpan */
.btn-save {
    background-color: #475569; /* BIRU-UNGU */
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    border: none;
    transition: background-color 0.3s ease;
}
.btn-save:hover {
    background-color: #475569; /* Biru-ungu sedikit lebih gelap saat hover */
}

/* Tombol Kembali */
.btn-cancel {
    background-color: #ccc;
    color: #333;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    margin-right: 10px;
    transition: background-color 0.3s ease;
}
.btn-cancel:hover {
    background-color: #bbb;
}

.form-btn-bottom {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}
</style>

<div class="form-page">
    <div class="form-container">
        <h2 class="text-2xl font-bold mb-6 text-center text-[#333]">Input Transaksi Baru</h2>

        {{-- Menampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Terjadi Kesalahan!</strong>
                <span class="block sm:inline">Mohon periksa input Anda.</span>
                <ul class="mt-2 list-disc list-inside">
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
                <label>Pegawai</label>
                <input type="text" value="{{ auth()->user()->name ?? 'Nama Pegawai Tidak Ditemukan' }}" readonly>
                <input type="hidden" name="id_pegawai" value="{{ auth()->id() }}">
            </div>

            <hr class="my-4 border-gray-400">

          <div class="form-group">
            <label for="id_barang">ID Barang</label>
            <input 
                type="text" 
                id="id_barang" 
                name="id_barang"
                value="{{ old('id_barang') }}"
                required
                pattern="[A-Z][0-9]{2}"
                placeholder="Contoh: A01"
                class="@error('id_barang') border-red-500 @enderror"
            >

            @error('id_barang')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>


                    <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang"
                value="{{ old('nama_barang') }}"
                required
                class="@error('nama_barang') border-red-500 @enderror">

            @error('nama_barang')
                <small style="color:red">{{ $message }}</small>
            @enderror
        </div>


           <div class="grid grid-cols-3 gap-4">
    <div class="form-group">
        <label for="harga_barang">Harga Satuan (Rp)</label>
        <input type="number" id="harga_barang" name="harga_barang"
            value="{{ old('harga_barang',0) }}"
            min="0" required
            class="@error('harga_barang') border-red-500 @enderror">

        @error('harga_barang')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="jumlah_barang">Jumlah Barang</label>
        <input type="number" id="jumlah_barang" name="jumlah_barang"
            value="{{ old('jumlah_barang',1) }}"
            min="1" required
            class="@error('jumlah_barang') border-red-500 @enderror">

        @error('jumlah_barang')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="total_harga_display">Total Harga</label>
        <input type="text" id="total_harga_display" value="Rp 0" readonly>
        <input type="hidden" name="total_harga" id="input_total_harga" value="0">
    </div>
</div>



            <div class="form-btn-bottom">
    <a href="{{ route('transaksi.menu') }}"
       class="btn-cancel px-6 py-2 rounded text-center">
        Kembali
    </a>

    <button type="submit"
            class="btn-save px-6 py-2 rounded">
        Simpan Transaksi
    </button>
</div>


@push('scripts')
<script>
    // ⚙️ Skrip untuk menghitung Total Harga secara otomatis
    const inputHarga = document.getElementById('harga_barang');
    const inputJumlah = document.getElementById('jumlah_barang');
    const displayTotal = document.getElementById('total_harga_display');
    const inputTotal = document.getElementById('input_total_harga');

    function calculateTotal() {
        const harga = parseFloat(inputHarga.value) || 0;
        const jumlah = parseInt(inputJumlah.value) || 0;
        const total = harga * jumlah;
        
        // Menampilkan total dengan format Rupiah
        displayTotal.value = 'Rp ' + total.toLocaleString('id-ID');
        // Menyimpan nilai numerik ke input tersembunyi untuk dikirim ke server
        inputTotal.value = total;
    }

    // Panggil fungsi perhitungan setiap kali nilai harga atau jumlah berubah
    inputHarga.addEventListener('input', calculateTotal);
    inputJumlah.addEventListener('input', calculateTotal);

    // Hitung saat pertama kali halaman dimuat (untuk mengisi nilai default)
    calculateTotal();

    // Cegah double submit (opsional: agar form tidak terkirim dua kali)
    document.getElementById('formTransaksi').addEventListener('submit', function(e){
        this.querySelector('button[type="submit"]').disabled = true;
    });
</script>
@endpush
@endsection