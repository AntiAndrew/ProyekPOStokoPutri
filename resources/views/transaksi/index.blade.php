@extends('layouts.app')

@section('title', 'Daftar Transaksi Lengkap')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body { background-color:#e6f7ff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
.screen-area { width:100%; max-width:1100px; background-color:#f0fff0; padding:25px 40px; box-shadow:0 4px 20px rgba(0,0,0,0.1); margin:30px auto; border-radius:12px; }
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid #b3e0b3; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#2e8b57; text-align:center; flex-grow:1; }
.header-icons a { font-size:20px; color:#555; margin-right:10px; text-decoration:none; border:1px solid #ccc; padding:8px 12px; border-radius:6px; transition:background-color 0.2s; }
.header-icons a:hover { background-color:#e0e0e0; }
.my-account i { color:#2e8b57; font-size:2.5rem; }
.detail-table { width:100%; border-collapse:collapse; margin-top:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
.detail-table th, .detail-table td { border:1px solid #e0e0e0; padding:12px 10px; text-align:left; }
.detail-table th { background-color:#d4edda; color:#155724; font-weight:700; }
.detail-table td { background-color:#fff; vertical-align:middle; }
.text-end { text-align:right; }
.text-center { text-align:center; }
.action-buttons { 
    display:flex; 
    justify-content:center; 
    gap:5px;
    flex-wrap:wrap; 
}
.btn { padding:5px 10px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; transition:background-color 0.3s, transform 0.1s; font-size:0.9rem; }
.btn:active { transform:scale(0.98); }
.btn-view { background-color:#4caf50; color:white; }

/* Lebar kolom */
.detail-table th:nth-child(1) { width:12%; }
.detail-table th:nth-child(2) { width:15%; }
.detail-table th:nth-child(3) { width:25%; }
.detail-table th:nth-child(4) { width:15%; }
.detail-table th:nth-child(5) { width:15%; }
.detail-table th:nth-child(6) { width:18%; }

@media (max-width:800px) {
    .screen-area { padding:15px 20px; margin:10px; }
    .header-title { font-size:20px; }
    .detail-table th, .detail-table td { padding:8px 5px; font-size:12px; }
}
</style>

<div class="screen-area">

   

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="detail-table">
            <thead>
                <tr>
                    <th>No. Ref</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Salesman</th>
                    <th class="text-end">Total Bayar (Rp)</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($transaksi as $trx)
                <tr>
                    <td>{{ $trx->no_transaksi ?? $trx->no_ref ?? '-' }}</td>

                    <td>{{ \Carbon\Carbon::parse($trx->tanggal ?? now())->format('d F Y') }}</td>

                    <td>{{ $trx->pelanggan ?? 'Umum' }}</td>

                    <td>{{ $trx->user->name ?? 'N/A' }}</td>

                    <td class="text-end">{{ number_format($trx->total ?? 0, 0, ',', '.') }}</td>

                    {{-- Kolom Aksi (HANYA VIEW) --}}
                    <td class="text-center">
                        <div class="action-buttons">
                            <a href="{{ route('transaksi.show', $trx->id) }}"
                               class="btn btn-view"
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection
