@extends('layouts.dashboard')

@section('title', $mode == 'edit' ? 'Edit Transaksi' : 'Hapus Transaksi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body { background-color:#e6f7ff; font-family: 'Inter', sans-serif; }
.screen-area { width:100%; max-width:1200px; background-color:#f0fff0; padding:25px 40px; box-shadow:0 4px 20px rgba(0,0,0,0.1); margin:30px auto; border-radius:12px; }
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid #b3e0b3; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#2e8b57; display:flex; align-items:center; }
.header-title span.emoji { color:#f5deb3; margin-right:8px; font-size:36px; line-height:1; font-weight:bold; text-shadow: 1px 1px 1px #555, -1px -1px 1px #555; display:inline-block; }
.header-title span.emoji.pencil { transform: rotate(-10deg) scale(1.1); }
.header-title span.emoji.trash { transform: scale(1.1); }
.btn { padding:6px 10px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; transition:background-color 0.3s, transform 0.1s; font-size:0.85rem; display: inline-flex; align-items: center; }
.btn:active { transform:scale(0.98); }
.btn-edit { background-color:#3b82f6; color:white; }
.btn-edit:hover { background-color:#2563eb; }
.btn-delete { background-color:#ef4444; color:white; }
.btn-delete:hover { background-color:#dc2626; }
.detail-table { width:100%; border-collapse:collapse; margin-top:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
.detail-table th, .detail-table td { border:1px solid #e0e0e0; padding:12px 10px; text-align:left; }
.detail-table th { background-color:#d4edda; color:#155724; font-weight:700; text-transform: uppercase; }
.detail-table td { background-color:#fff; vertical-align:middle; font-size: 0.9rem; }
.text-end { text-align:right; }
.text-center { text-align:center; }
.action-buttons { display:flex; justify-content:center; gap:5px; }
.detail-table th:nth-child(1) { width:10%; } 
.detail-table th:nth-child(2) { width:10%; } 
.detail-table th:nth-child(3) { width:10%; } 
.detail-table th:nth-child(4) { width:10%; } 
.detail-table th:nth-child(5) { width:25%; } 
.detail-table th:nth-child(6) { width:15%; } 
.detail-table th:nth-child(7) { width:15%; }
.tooltip { position: relative; display: inline-block; }
.tooltip .tooltiptext { visibility: hidden; width: 140px; background-color: #647b69ff; color: #fff; text-align: center; border-radius: 6px; padding: 6px 8px; position: absolute; z-index: 1; bottom: 125%; left: 50%; margin-left: -70px; opacity: 0; transition: opacity 0.3s; font-size: 12px; }
.tooltip:hover .tooltiptext { visibility: visible; opacity: 1; }
@media (max-width:1024px) { .detail-table th, .detail-table td { padding:8px 5px; font-size:12px; } }
@media (max-width:600px) { .screen-area { padding:15px; margin:10px; } .header { flex-direction: column; align-items: flex-start; } .header-title { margin-bottom: 10px; } }
</style>

<div class="screen-area">

    {{-- Header tanpa tombol ganti mode --}}
    <div class="header">
        <h1 class="header-title">
            @if($mode == 'edit')
                <span class="emoji pencil">✏</span>
            @else
                <span class="emoji trash">🗑</span>
            @endif
            Kelola {{ $mode == 'edit' ? 'Edit Transaksi' : 'Hapus Transaksi' }}
        </h1>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-md mb-6" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel transaksi --}}
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
                @forelse($data as $trx)
                <tr>
                    <td>{{ $trx->id_transaksi }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $trx->pegawai->name ?? 'N/A' }}</td>
                    <td>{{ $trx->id_barang }}</td>
                    <td>{{ $trx->nama_barang }}</td>
                    <td class="text-end">{{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <div class="action-buttons">
                            @if ($mode == 'edit')
                                <a href="{{ route('transaksi.edit', $trx->id_transaksi) }}" class="btn btn-edit" title="Edit Transaksi">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @else
                                <button onclick="confirmDelete('{{ $trx->id_transaksi }}', '{{ route('transaksi.destroy', $trx->id_transaksi) }}')"
                                        class="btn btn-delete" title="Hapus Transaksi">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Belum ada transaksi. 
                        @if (Route::has('transaksi.create'))
                            Silakan <a href="{{ route('transaksi.create') }}" style="color:#2e8b57; font-weight:semibold; text-decoration:underline;">input baru</a>.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tombol Kembali di bawah tabel sebelah kiri --}}
    <div class="mt-4 flex justify-start">
    <a href="{{ route('transaksi.menu') }}" 
       class="btn" 
       style="background-color:#2e8b57; color:white; padding:10px 18px; font-weight:bold; border-radius:6px; text-decoration:none; display:inline-flex; align-items:center; gap:5px; transition: background-color 0.2s;">
        Kembali
    </a>
</div>




    {{-- Paginasi --}}
    @if(method_exists($data, 'links'))
        <div class="mt-4 flex justify-center">
            {{ $data->links() }}
        </div>
    @endif

</div>

{{-- Modal Hapus --}}
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center p-4" style="z-index: 1000;">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm p-6 border border-red-500">
        <h3 class="text-xl font-bold text-red-600 mb-3"><i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus</h3>
        <p class="text-sm text-gray-700 mb-5">
            Anda yakin ingin **menghapus permanen** transaksi **ID #<span id="transaksiRef" class="font-bold text-red-600"></span>**? 
            Stok barang akan dikembalikan. Tindakan ini tidak dapat dibatalkan.
        </p>
        <div class="flex justify-end space-x-3">
            <button onclick="document.getElementById('deleteModal').classList.add('hidden'); document.getElementById('deleteModal').classList.remove('flex');" 
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                Batal
            </button>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(transaksiRef, deleteUrl) { 
        document.getElementById('transaksiRef').innerText = transaksiRef;
        const form = document.getElementById('deleteForm');
        form.action = deleteUrl; 
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteModal').classList.add('flex');
    }
</script>

@endsection
