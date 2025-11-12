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
.detail-table td { background-color:#fff; vertical-align:top; }
.text-end { text-align:right; }
.text-center { text-align:center; }
.summary-box { margin-top:10px; padding:10px 15px; background-color:#f7fcf7; border-radius:8px; border:1px solid #b3e0b3; font-size:1rem; }
.summary-row { display:flex; justify-content:space-between; margin-bottom:5px; }
.action-buttons { display:flex; justify-content:flex-end; gap:10px; margin-top:10px; flex-wrap:wrap; }
.btn { padding:8px 20px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; transition:background-color 0.3s, transform 0.1s; }
.btn:active { transform:scale(0.98); }
.btn-edit { background-color:#ff9800; color:white; }
.btn-delete { background-color:#f44336; color:white; }
.btn-view { background-color:#4caf50; color:white; }
@media (max-width:800px) { 
    .screen-area { padding:15px 20px; margin:10px; } 
    .header-title { font-size:20px; } 
    .detail-table th, .detail-table td { padding:8px 5px; font-size:12px; } 
    .action-buttons { flex-direction:column; gap:8px; align-items:stretch; } 
}
</style>

<div class="screen-area">

    <div class="header">
        <div class="header-icons">
            <a href="{{ url('/') }}" title="Home"><i class="fas fa-home"></i></a>
        </div>
        <div class="header-title">Daftar Transaksi Lengkap</div>
        <a href="#" class="my-account"><i class="fas fa-user-circle"></i></a>
    </div>

    <div class="table-responsive">
        <table class="detail-table">
            <thead>
                <tr>
                    <th>No. Ref</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Salesman</th>
                    <th>Item Barang</th>
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
                    <td>
                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th style="width:20%;">Kode</th>
                                    <th style="width:40%;">Produk</th>
                                    <th style="width:20%;" class="text-center">Qty</th>
                                    <th style="width:20%;" class="text-end">Harga (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trx->items as $item)
                                <tr>
                                    <td>{{ $item->id_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td class="text-center">{{ number_format($item->jumlah,0,',','.') }} {{ $item->barang->satuan ?? '' }}</td>
                                    <td class="text-end">{{ number_format($item->harga_satuan,0,',','.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada item</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="summary-box">
                            <div class="summary-row"><span>Subtotal</span><span class="text-end">Rp {{ number_format($trx->subtotal ?? 0,0,',','.') }}</span></div>
                            <div class="summary-row"><span>Diskon</span><span class="text-end">Rp {{ number_format($trx->diskon ?? 0,0,',','.') }}</span></div>
                            <div class="summary-row"><span>Total</span><span class="text-end">Rp {{ number_format($trx->total ?? 0,0,',','.') }}</span></div>
                        </div>
                    </td>
                    <td class="text-end">{{ number_format($trx->total ?? 0,0,',','.') }}</td>
                    <td class="text-center">
                        <div class="action-buttons">
                            <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-view"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi {{ $trx->no_transaksi }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
