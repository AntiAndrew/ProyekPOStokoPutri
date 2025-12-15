@extends('layouts.app')

@section('title', 'Daftar Transaksi Lengkap')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body {
    background-color:#e9eef5; /* biru abu muda */
    font-family:'Inter', sans-serif;
}

.screen-area {
    width:100%;
    max-width:1200px;
    background-color:#ffffff;
    padding:25px 40px;
    box-shadow:0 8px 28px rgba(15,23,42,0.08);
    margin:30px auto;
    border-radius:14px;
}

/* Header */
.header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    border-bottom:2px solid #cbd5e1;
    padding-bottom:15px;
}
.header-title {
    font-size:28px;
    font-weight:700;
    color:#1e293b; /* biru tua */
    margin:0;
}

/* Tabel */
.detail-table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}
.detail-table th,
.detail-table td {
    border:1px solid #cbd5e1;
    padding:12px 10px;
    text-align:left;
}
.detail-table th {
    background-color:#e2e8f0; /* biru abu soft */
    color:#1e293b;
    font-weight:700;
    text-transform:uppercase;
    font-size:0.8rem;
}
.detail-table td {
    background-color:#ffffff;
    font-size:0.9rem;
}
.detail-table tr:hover td {
    background-color:#f1f5f9;
}

.text-end { text-align:right; }
.text-center { text-align:center; }

/* Tombol */
.action-buttons {
    display:flex;
    justify-content:center;
    gap:6px;
}
.btn {
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    font-size:0.85rem;
    transition:background-color 0.2s, transform 0.1s;
    display:inline-flex;
    align-items:center;
    gap:6px;
}
.btn:active { transform:scale(0.97); }

.btn-view {
    background-color:#334155; /* biru abu */
    color:white;
}
.btn-view:hover {
    background-color:#1e293b;
}

.btn-back {
    background-color:#475569; /* abu gelap */
    color:white;
    padding:10px 18px;
    border-radius:6px;
    font-weight:bold;
    text-decoration:none;
}
.btn-back:hover {
    background-color:#334155;
}

/* Responsif */
@media (max-width:1024px) {
    .detail-table th,
    .detail-table td {
        padding:8px 5px;
        font-size:12px;
    }
}
@media (max-width:600px) {
    .screen-area {
        padding:15px;
        margin:10px;
    }
    .header-title {
        font-size:24px;
    }
}
</style>

<div class="screen-area">

    <div class="header">
        <h1 class="header-title">📜 Daftar Transaksi Lengkap</h1>
    </div>

    <div class="overflow-x-auto">
        <table class="detail-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Pegawai</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th class="text-end">Total Bayar (Rp)</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $trx)
                <tr>
                    <td>{{ $trx->id_transaksi }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $trx->pegawai->name ?? 'N/A' }}</td>
                    <td>{{ $trx->id_barang }}</td>
                    <td>{{ $trx->nama_barang }}</td>
                    <td class="text-end">{{ number_format($trx->total_harga,0,',','.') }}</td>
                    <td class="text-center">
                        <div class="action-buttons">
                            <a href="{{ route('transaksi.show',$trx->id_transaksi) }}" class="btn btn-view">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500">
                        Belum ada transaksi.
                        <a href="{{ route('transaksi.create') }}" class="text-slate-700 font-semibold hover:underline">
                            Input baru
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('transaksi.menu') }}" class="btn-back">
            Kembali
        </a>
    </div>

    @if(method_exists($transaksi,'links'))
        <div class="mt-6 flex justify-center">
            {{ $transaksi->links() }}
        </div>
    @endif

</div>
@endsection
