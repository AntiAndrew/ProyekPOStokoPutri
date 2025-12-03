@extends('layouts.app')

@section('title', 'Daftar Transaksi Lengkap')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body { background-color:#e6f7ff; font-family: 'Inter', sans-serif; }
.screen-area { width:100%; max-width:1200px; background-color:#f0fff0; padding:25px 40px; box-shadow:0 4px 20px rgba(0,0,0,0.1); margin:30px auto; border-radius:12px; }

/* Header */
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid #b3e0b3; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#2e8b57; margin:0; }
.header-actions { display:flex; gap:10px; }
.btn-create { background-color:#2e8b57; color:white; padding:10px 15px; border-radius:6px; font-weight:bold; text-decoration:none; transition:background-color 0.2s; }
.btn-create:hover { background-color:#1e6e41; }

/* Tabel */
.detail-table { width:100%; border-collapse:collapse; margin-top:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
.detail-table th, .detail-table td { border:1px solid #e0e0e0; padding:12px 10px; text-align:left; }
.detail-table th { background-color:#d4edda; color:#155724; font-weight:700; text-transform:uppercase; }
.detail-table td { background-color:#fff; vertical-align:middle; font-size:0.9rem; }
.text-end { text-align:right; }
.text-center { text-align:center; }
.action-buttons { display:flex; justify-content:center; gap:5px; }
.btn { padding:6px 10px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; transition:background-color 0.3s, transform 0.1s; font-size:0.85rem; }
.btn:active { transform:scale(0.98); }
.btn-view { background-color:#4caf50; color:white; }

/* Penyesuaian Lebar Kolom */
.detail-table th:nth-child(1) { width:10%; } 
.detail-table th:nth-child(2) { width:10%; } 
.detail-table th:nth-child(3) { width:10%; } 
.detail-table th:nth-child(4) { width:10%; } 
.detail-table th:nth-child(5) { width:25%; } 
.detail-table th:nth-child(6) { width:15%; } 
.detail-table th:nth-child(7) { width:15%; }

/* Responsif */
@media (max-width:1024px) {
    .detail-table th, .detail-table td { padding:8px 5px; font-size:12px; }
}
@media (max-width:600px) {
    .screen-area { padding:15px; margin:10px; }
    .header { flex-direction:row; justify-content:space-between; align-items:center; }
    .header-title { font-size:24px; margin-bottom:0; }
}
</style>

<div class="screen-area">

   <div class="header">
    <h1 class="header-title">📜 Daftar Transaksi Lengkap</h1>
</div>


    <div class="table-responsive overflow-x-auto">
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
                    <td class="text-end">{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <div class="action-buttons">
                            <a href="{{ route('transaksi.show', $trx->id_transaksi) }}" 
                               class="btn btn-view" title="Lihat Detail">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada transaksi. Silakan <a href="{{ route('transaksi.create') }}" class="text-blue-600 font-semibold hover:underline">input baru</a>.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tombol Kembali di bawah tabel sebelah kiri --}}
    <div class="mt-4 flex justify-start">
        <a href="{{ route('transaksi.menu') }}" class="btn-create" style="background-color:#6c757d;">
            Kembali
        </a>
    </div>

    @if(method_exists($transaksi, 'links'))
        <div class="mt-4 flex justify-center">
            {{ $transaksi->links() }}
        </div>
    @endif

</div>
@endsection
