@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@php
    // Ambil item transaksi, atau tampilkan placeholder jika kosong
    $items = $transaksi->items ?? collect();
    $items_to_show = $items->isNotEmpty()
        ? $items
        : collect([
            (object)[
                'id_barang' => '',
                'nama_barang' => 'Belum ada barang ditambahkan',
                'jumlah' => 0,
                'harga_satuan' => 0,
                'subtotal' => 0,
                'barang' => (object)['satuan' => '']
            ]
        ]);
@endphp

<style>
body {
    background-color: #e6f7ff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.screen-area {
    width: 100%;
    max-width: 900px;
    background-color: #ffffff;
    padding: 30px 40px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin: 40px auto;
    border-radius: 12px;
}

/* Detail Transaksi */
.detail-header-info {
    /* Margin atas disesuaikan karena header utama dihapus */
    margin-top: 5px; 
    margin-bottom: 30px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    padding: 15px;
    border: 1px dashed #b3e0b3;
    border-radius: 8px;
}
.detail-row {
    margin-bottom: 6px;
    font-size: 15px;
}
.detail-label {
    font-weight: 600;
    color: #333;
    display: inline-block;
    width: 100px;
}
.detail-value {
    margin-left: 5px;
}

/* Tabel Barang */
.detail-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.detail-table th, .detail-table td {
    border: 1px solid #e0e0e0;
    padding: 10px;
    text-align: left;
}
.detail-table th {
    background-color: #d4edda;
    color: #155724;
    font-weight: bold;
}
.detail-table tr:hover td {
    background-color: #f8fff8;
}
.text-end { text-align: right; }
.text-center { text-align: center; }

/* Ringkasan */
.summary-box {
    margin-top: 20px;
    padding: 15px;
    background-color: #f7fcf7;
    border-radius: 8px;
    border: 1px solid #b3e0b3;
    font-size: 1rem;
}
.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}
.total-bayar {
    font-size: 1.3rem;
    font-weight: bold;
    color: #2e8b57;
    border-top: 2px solid #b3e0b3;
    padding-top: 10px;
    margin-top: 10px;
}

/* Tombol Aksi */
.action-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 30px;
}
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    transition: all 0.2s ease;
}
.btn i {
    margin-right: 6px;
}
.btn-edit {
    background-color: #ff9800;
    color: white;
}
.btn-delete {
    background-color: #f44336;
    color: white;
}
.btn:hover {
    opacity: 0.9;
}
@media (max-width: 600px) {
    .screen-area { padding: 20px; }
    .detail-header-info { grid-template-columns: 1fr; }
    .action-buttons { flex-direction: column; align-items: stretch; }
}
</style>

<div class="screen-area">

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-3">{{ session('error') }}</div>
    @endif

    {{-- Info Transaksi --}}
    <div class="detail-header-info">
        <div>
            <div class="detail-row"><span class="detail-label">No. Ref</span><span class="detail-value">: {{ $transaksi->no_transaksi ?? $transaksi->kode_ref ?? 'N/A' }}</span></div>
            <div class="detail-row"><span class="detail-label">Tanggal</span><span class="detail-value">: {{ \Carbon\Carbon::parse($transaksi->tanggal ?? $transaksi->created_at)->translatedFormat('d F Y') }}</span></div>
        </div>
        <div>
            <div class="detail-row"><span class="detail-label">Pelanggan</span><span class="detail-value">: {{ $transaksi->pelanggan ?? 'Umum' }}</span></div>
            <div class="detail-row"><span class="detail-label">Kasir</span><span class="detail-value">: {{ $transaksi->user->name ?? 'Tidak Diketahui' }}</span></div>
        </div>
    </div>

    {{-- Daftar Barang --}}
    <h5 style="color:#2e8b57; font-weight:600;">Item Barang</h5>
    <div class="table-responsive">
        <table class="detail-table">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Produk</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Harga Satuan (Rp)</th>
                    <th class="text-end">Subtotal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items_to_show as $item)
                    <tr>
                        <td>{{ $item->id_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td class="text-center">{{ number_format($item->jumlah, 0, ',', '.') }} {{ $item->barang->satuan ?? '' }}</td>
                        <td class="text-end">{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-end">{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Ringkasan --}}
    <div class="summary-box">
        <div class="summary-row"><span>Subtotal</span><span>Rp {{ number_format($transaksi->subtotal ?? 0, 0, ',', '.') }}</span></div>
        <div class="summary-row"><span>Diskon</span><span>Rp {{ number_format($transaksi->diskon ?? 0, 0, ',', '.') }}</span></div>
        <div class="summary-row total-bayar"><span>Total Bayar</span><span>Rp {{ number_format($transaksi->total ?? 0, 0, ',', '.') }}</span></div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="action-buttons">
        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-edit">
            <i class="fas fa-edit"></i> Edit Transaksi
        </a>
        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">
                <i class="fas fa-trash-alt"></i> Hapus Transaksi
            </button>
        </form>
    </div>

</div>
@endsection