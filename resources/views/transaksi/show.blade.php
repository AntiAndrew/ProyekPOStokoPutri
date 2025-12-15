@extends('layouts.dashboard')

@section('title', 'Detail Transaksi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body { background-color: #e6f7ff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
.screen-area { width: 100%; max-width: 900px; background-color: #ffffff; padding: 30px 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin: 40px auto; border-radius: 12px; }

.detail-header-info { margin-top: 5px; margin-bottom: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 15px; padding: 15px; border: 1px dashed #b3e0b3; border-radius: 8px; }
.detail-row { margin-bottom: 6px; font-size: 15px; }
.detail-label { font-weight: 600; color: #333; display: inline-block; width: 100px; }
.detail-value { margin-left: 5px; }

.detail-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
.detail-table th, .detail-table td { border: 1px solid #e0e0e0; padding: 10px; text-align: left; }
.detail-table th { background-color: #d4edda; color: #155724; font-weight: bold; }
.detail-table tr:hover td { background-color: #f8fff8; }
.text-end { text-align: right; }
.text-center { text-align: center; }

.summary-box { margin-top: 20px; padding: 15px; background-color: #f7fcf7; border-radius: 8px; border: 1px solid #b3e0b3; font-size: 1rem; }
.summary-row { display: flex; justify-content: space-between; margin-bottom: 5px; }
.total-bayar { font-size: 1.3rem; font-weight: bold; color: #2e8b57; border-top: 2px solid #b3e0b3; padding-top: 10px; margin-top: 10px; }

@media (max-width: 600px) {
    .screen-area { padding: 20px; }
    .detail-header-info { grid-template-columns: 1fr; }
}
</style>

<div class="screen-area">

    {{-- Info Transaksi --}}
    <div class="detail-header-info">
        <div>
            <div class="detail-row"><span class="detail-label">ID Transaksi</span><span class="detail-value">: {{ $transaksi->id_transaksi }}</span></div>
            <div class="detail-row"><span class="detail-label">Tanggal</span><span class="detail-value">: {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d F Y') }}</span></div>
        </div>
        <div>
            <div class="detail-row"><span class="detail-label">Pegawai</span><span class="detail-value">: {{ $transaksi->pegawai->name ?? 'N/A' }}</span></div>
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

    {{-- Ringkasan Total --}}
    <div class="summary-box">
        <div class="summary-row total-bayar"><span>Total Bayar</span><span>Rp {{ number_format($transaksi->total_harga,0,',','.') }}</span></div>
    </div>

</div>
@endsection
