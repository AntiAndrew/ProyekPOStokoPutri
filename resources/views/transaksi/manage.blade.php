@extends('layouts.app')

@section('title', $mode == 'edit' ? 'Edit Transaksi' : 'Hapus Transaksi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body { 
    background-color:#e9edf2; 
    font-family: 'Inter', sans-serif; 
}

.screen-area {
    width:100%;
    max-width:1200px;
    background-color:#ffffff;
    padding:25px 40px;
    box-shadow:0 6px 24px rgba(0,0,0,0.08);
    margin:30px auto;
    border-radius:14px;
}

.header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    border-bottom:2px solid #d1d5db;
    padding-bottom:15px;
}

.header-title {
    font-size:28px;
    font-weight:700;
    color:#1f2a36;
    display:flex;
    align-items:center;
}

.header-title span.emoji {
    margin-right:8px;
    font-size:34px;
}

.btn {
    padding:6px 12px;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-weight:600;
    transition:background-color 0.2s, transform 0.1s;
    font-size:0.85rem;
    display:inline-flex;
    align-items:center;
    gap:6px;
}

.btn:active { transform:scale(0.97); }

.btn-edit { background-color:#2f3e4e; color:white; }
.btn-edit:hover { background-color:#1f2a36; }

.btn-delete { background-color:#b91c1c; color:white; }
.btn-delete:hover { background-color:#991b1b; }

.detail-table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

.detail-table th,
.detail-table td {
    border:1px solid #d1d5db;
    padding:12px 10px;
    text-align:left;
}

.detail-table th {
    background-color:#e5e7eb;
    color:#1f2a36;
    font-weight:700;
    text-transform:uppercase;
    font-size:0.8rem;
}

.detail-table td {
    background-color:#ffffff;
    font-size:0.9rem;
}

.detail-table tr:hover td {
    background-color:#f3f4f6;
}

.text-end { text-align:right; }
.text-center { text-align:center; }

.action-buttons {
    display:flex;
    justify-content:center;
    gap:6px;
}

@media (max-width:600px) {
    .screen-area { padding:15px; margin:10px; }
    .header { flex-direction:column; align-items:flex-start; }
}
</style>

<div class="screen-area">

    {{-- Header --}}
    <div class="header">
        <h1 class="header-title">
            @if($mode == 'edit')
                ✏ Edit Transaksi
            @else
                🗑 Hapus Transaksi
            @endif
        </h1>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="bg-gray-100 border border-gray-300 text-gray-800 px-4 py-3 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-md mb-6">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="detail-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Pegawai</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th class="text-end">Total Bayar</th>
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
                    <td class="text-end">{{ number_format($trx->total_harga,0,',','.') }}</td>
                    <td class="text-center">
                        <div class="action-buttons">
                            @if ($mode == 'edit')
                                <a href="{{ route('transaksi.edit', $trx->id_transaksi) }}" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @else
                                <button onclick="confirmDelete('{{ $trx->id_transaksi }}','{{ route('transaksi.destroy',$trx->id_transaksi) }}')"
                                        class="btn btn-delete">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500">
                        Belum ada transaksi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-4">
        <a href="{{ route('transaksi.menu') }}"
           class="btn"
           style="background:#3b4b5c;color:white;">
            Kembali
        </a>
    </div>

    {{-- Pagination --}}
    @if(method_exists($data,'links'))
        <div class="mt-6 flex justify-center">
            {{ $data->links() }}
        </div>
    @endif
</div>

{{-- Modal Delete --}}
<div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center p-4 z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-sm p-6 border border-red-400">
        <h3 class="text-lg font-bold text-red-600 mb-3">
            ⚠ Konfirmasi Hapus
        </h3>
        <p class="text-sm text-gray-700 mb-5">
            Hapus transaksi ID <b>#<span id="transaksiRef"></span></b>?
        </p>
        <div class="flex justify-end gap-3">
            <button onclick="closeModal()"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Batal
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, url) {
    document.getElementById('transaksiRef').innerText = id;
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}
function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}
</script>
@endsection
