@extends('layouts.app')
@section('title', 'Laporan Penjualan')
@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-pastel-dark mb-6 text-center">Laporan Penjualan</h2>

        <!-- Filter rentang waktu -->
        <form method="GET" action="{{ route('laporan.penjualan') }}" class="mb-6">
            <h4 class="text-lg font-semibold text-pastel-dark mb-4">Rentang Waktu</h4>
            <div class="mb-4">
                <select name="rentang" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-pastel-green">
                    <option value="hari_ini" {{ $filter == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="7_hari" {{ $filter == '7_hari' ? 'selected' : '' }}>7 Hari Terakhir</option>
                    <option value="bulan" {{ $filter == 'bulan' ? 'selected' : '' }}>Pilih Bulan</option>
                    <option value="tanggal" {{ $filter == 'tanggal' ? 'selected' : '' }}>Pilih Tanggal</option>
                </select>
            </div>
            <button type="submit" class="bg-pastel-green hover:bg-pastel-green/80 text-white font-bold py-2 px-4 rounded transition duration-150">
                Filter
            </button>
        </form>

        <!-- Tabel laporan -->
        <div class="overflow-x-auto">
            <table class="data-table w-full">
                <thead>
                    <tr>
                        <th>Kode/ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga Barang</th>
                        <th>Total Pembayaran</th>
                        <th>HPP</th>
                        <th>Keuntungan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                    <tr>
                        @if(is_array($row))
                            @foreach($row as $col)
                            <td>{{ $col }}</td>
                            @endforeach
                        @else
                            <td>{{ $row->id_barang ?? 'N/A' }}</td>
                            <td>{{ $row->nama_barang ?? 'N/A' }}</td>
                            <td>{{ $row->metode_pembayaran ?? 'N/A' }}</td>
                            <td>{{ $row->jumlah ?? 'N/A' }}</td>
                            <td>{{ $row->satuan ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($row->harga_barang ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($row->total_pembayaran ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($row->hpp ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($row->keuntungan ?? 0, 0, ',', '.') }}</td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada data laporan penjualan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
