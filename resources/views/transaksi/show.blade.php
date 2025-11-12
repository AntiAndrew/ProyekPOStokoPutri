@extends('layouts.app')

@section('title', 'Lihat Detail Transaksi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@php
    // Placeholder jika transaksi tidak punya item
    $items_to_show = ($transaksi->items ?? collect())->isNotEmpty() 
        ? $transaksi->items 
        : collect([ (object)[
            'id_barang' => '',
            'nama_barang' => 'Belum ada detail barang terinput',
            'jumlah' => 0,
            'harga_satuan' => 0,
            'subtotal' => 0,
            'barang' => (object)['satuan' => '']
        ]]);
@endphp

<style>
/* CSS sudah rapi, gunakan yang terakhir kamu buat */
body { background-color:#e6f7ff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
.screen-area { width:100%; max-width:900px; background-color:#f0fff0; padding:25px 40px; box-shadow:0 4px 20px rgba(0,0,0,0.1); margin:30px auto; border-radius:12px; }
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid #b3e0b3; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#2e8b57; text-align:center; flex-grow:1; }
.header-icons a { font-size:20px; color:#555; margin-right:10px; text-decoration:none; border:1px solid #ccc; padding:8px 12px; border-radius:6px; transition:background-color 0.2s; }
.header-icons a:hover { background-color:#e0e0e0; }
.my-account i { color:#2e8b57; font-size:2.5rem; }
.detail-header-info { margin-top:15px; margin-bottom:30px; display:grid; grid-template-columns:1fr 1fr; gap:15px; padding:10px; border:1px dashed #b3e0b3; border-radius:8px; }
.detail-row { margin-bottom:5px; font-size:15px; }
.detail-label { font-weight:600; color:#333; display:inline-block; width:100px; }
.detail-value { margin-left:5px; }
.detail-table { width:100%; border-collapse:collapse; margin-top:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
.detail-table th, .detail-table td { border:1px solid #e0e0e0; padding:12px 10px; text-align:left; }
.detail-table th { background-color:#d4edda; color:#155724; font-weight:700; }
.detail-table td { background-color:#fff; }
.text-end { text-align:right; }
.text-center { text-align:center; }
.summary-box { margin-top:20px; padding:15px; background-color:#f7fcf7; border-radius:8px; border:1px solid #b3e0b3; font-size:1.1rem; }
.summary-row { display:flex; justify-content:space-between; margin-bottom:5px; }
.total-bayar { font-size:1.5rem; font-weight:bold; color:#2e8b57; border-top:2px solid #b3e0b3; padding-top:10px; margin-top:10px; }
.action-buttons { display:flex; justify-content:flex-end; gap:15px; margin-top:30px; }
.btn { padding:10px 25px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; transition:background-color 0.3s, transform 0.1s; }
.btn:active { transform:scale(0.98); }
.btn-edit { background-color:#ff9800; color:white; }
.btn-delete { background-color:#f44336; color:white; }
@media (max-width:600px) { .screen-area { padding:15px 20px; margin:10px; } .header-title { font-size:20px; } .detail-header-info { grid-template-columns:1fr; } .detail-table th, .detail-table td { padding:8px 5px; font-size:12px; } .action-buttons { flex-direction:column; gap:10px; align-items:stretch; } }
</style>

<div class="screen-area">

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mb-3">{{ session('error') }}</div>
    @endif

    <div class="header">
        <div class="header-icons">
            <a href="{{ url()->previous() }}" title="Kembali"><i class="fas fa-arrow-left"></i></a> 
            <a href="{{ url('/') }}" title="Home"><i class="fas fa-home"></i></a>
        </div>
        <div class="header-title">Detail Transaksi</div>
        <a href="#" class="my-account"><i class="fas fa-user-circle"></i></a>
    </div>

    {{-- Detail transaksi --}}
    <div class="detail-header-info">
        <div>
            <div class="detail-row"><span class="detail-label">No. Ref</span><span class="detail-value">: {{ $transaksi->no_transaksi ?? $transaksi->no_ref ?? 'N/A' }}</span></div>
            <div class="detail-row"><span class="detail-label">Tanggal</span><span class="detail-value">: {{ \Carbon\Carbon::parse($transaksi->tanggal ?? now())->format('d F Y') }}</span></div>
        </div>
        <div>
            <div class="detail-row"><span class="detail-label">Pelanggan</span><span class="detail-value">: {{ $transaksi->pelanggan ?? 'Umum' }}</span></div>
            <div class="detail-row"><span class="detail-label">Salesman</span><span class="detail-value">: {{ $transaksi->user->name ?? 'N/A' }}</span></div>
        </div>
    </div>

    <h5 style="color:#2e8b57; font-weight:600;">Item Barang</h5>
    <div class="table-responsive">
        <table class="detail-table">
            <thead>
                <tr>
                    <th style="width:15%;">Kode Barang</th>
                    <th style="width:35%;">Produk</th>
                    <th class="text-center" style="width:10%;">Qty</th>
                    <th class="text-end" style="width:20%;">Harga Satuan (Rp)</th>
                    <th class="text-end" style="width:20%;">Subtotal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items_to_show as $item)
                <tr>
                    <td>{{ $item->id_barang }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td class="text-center">{{ number_format($item->jumlah,0,',','.') }} {{ $item->barang->satuan ?? '' }}</td>
                    <td class="text-end">{{ number_format($item->harga_satuan,0,',','.') }}</td>
                    <td class="text-end">{{ number_format($item->subtotal,0,',','.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Summary --}}
    <div class="row justify-content-end">
        <div class="col-md-5 col-lg-4">
            <div class="summary-box">
                <div class="summary-row"><span>Subtotal</span><span class="text-end">Rp {{ number_format($transaksi->subtotal ?? 0,0,',','.') }}</span></div>
                <div class="summary-row"><span>Diskon</span><span class="text-end">Rp {{ number_format($transaksi->diskon ?? 0,0,',','.') }}</span></div>
                <div class="summary-row total-bayar"><span>TOTAL BAYAR</span><span class="text-end">Rp {{ number_format($transaksi->total ?? 0,0,',','.') }}</span></div>
            </div>
        </div>
    </div>

    {{-- Tombol aksi --}}
    <div class="action-buttons">
        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-edit"><i class="fas fa-edit me-1"></i> Edit Transaksi</a>
        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi {{ $transaksi->no_transaksi }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete"><i class="fas fa-trash-alt me-1"></i> Hapus Transaksi</button>
        </form>
    </div>

</div>
@endsection
