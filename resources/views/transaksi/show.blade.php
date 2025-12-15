@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body {
    background-color:#e9eef5; /* biru abu muda */
    font-family:'Inter', sans-serif;
}

.screen-area {
    width:100%;
    max-width:900px;
    background-color:#ffffff;
    padding:30px 40px;
    box-shadow:0 8px 28px rgba(15,23,42,0.1);
    margin:40px auto;
    border-radius:14px;
}

/* Info Header */
.detail-header-info {
    margin-top:5px;
    margin-bottom:30px;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    padding:15px;
    border:1px dashed #94a3b8;
    border-radius:10px;
    background-color:#f1f5f9;
}

.detail-row {
    margin-bottom:6px;
    font-size:15px;
}

.detail-label {
    font-weight:600;
    color:#1e293b; /* biru tua */
    display:inline-block;
    width:110px;
}

.detail-value {
    margin-left:5px;
    color:#334155;
}

/* Table */
.detail-table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

.detail-table th,
.detail-table td {
    border:1px solid #cbd5e1;
    padding:10px;
    text-align:left;
}

.detail-table th {
    background-color:#e2e8f0;
    color:#1e293b;
    font-weight:700;
}

.detail-table tr:hover td {
    background-color:#f1f5f9;
}

.text-end { text-align:right; }
.text-center { text-align:center; }

/* Summary */
.summary-box {
    margin-top:20px;
    padding:16px;
    background-color:#f1f5f9;
    border-radius:10px;
    border:1px solid #cbd5e1;
    font-size:1rem;
}

.summary-row {
    display:flex;
    justify-content:space-between;
    margin-bottom:5px;
}

.total-bayar {
    font-size:1.25rem;
    font-weight:700;
    color:#1e293b;
    border-top:2px solid #cbd5e1;
    padding-top:10px;
    margin-top:10px;
}

/* Judul Section */
.section-title {
    color:#1e293b;
    font-weight:700;
    margin-bottom:10px;
}

/* Responsive */
@media (max-width:600px) {
    .screen-area {
        padding:20px;
    }
    .detail-header-info {
        grid-template-columns:1fr;
    }
}
</style>

<div class="screen-area">

    <div class="detail-header-info">
        <div>
            <div class="detail-row">
                <span class="detail-label">ID Transaksi</span>
                <span class="detail-value">: {{ $transaksi->id_transaksi }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal</span>
                <span class="detail-value">: {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d F Y') }}</span>
            </div>
        </div>
        <div>
            <div class="detail-row">
                <span class="detail-label">Pegawai</span>
                <span class="detail-value">: {{ $transaksi->pegawai->name ?? 'N/A' }}</span>
            </div>
        </div>
    </div>

    <h5 class="section-title">Item Barang</h5>

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
                <tr>
                    <td>{{ $transaksi->id_barang }}</td>
                    <td>{{ $transaksi->nama_barang }}</td>
                    <td class="text-center">{{ $transaksi->jumlah_barang }}</td>
                    <td class="text-end">{{ number_format($transaksi->harga_barang,0,',','.') }}</td>
                    <td class="text-end">{{ number_format($transaksi->total_harga,0,',','.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="summary-box">
        <div class="summary-row total-bayar">
            <span>Total Bayar</span>
            <span>Rp {{ number_format($transaksi->total_harga,0,',','.') }}</span>
        </div>
    </div>

</div>
@endsection
