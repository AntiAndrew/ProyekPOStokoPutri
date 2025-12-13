@extends('layouts.dashboard')
@section('title', 'Laporan Penjualan')
@section('content')
<div class="container mx-auto p-6">
    <div class="bg-indigo-50 rounded-lg shadow-lg p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Laporan Penjualan</h2>
            <div class="text-sm text-gray-600">
                <i class="fas fa-calendar-alt mr-2"></i>
                {{ now()->format('l, d F Y') }}
            </div>
        </div>

        <!-- Filter rentang waktu -->
        <div class="bg-gray-50 rounded-lg p-6 mb-8">
            <h4 class="text-xl font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-filter mr-2 text-indigo-400"></i>
                Filter Rentang Waktu
            </h4>
            <form method="GET" action="{{ route('laporan.penjualan') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Filter</label>
                        <select name="rentang" id="rentang" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                            <option value="hari_ini" {{ $filter == 'hari_ini' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="7_hari" {{ $filter == '7_hari' ? 'selected' : '' }}>7 Hari Terakhir</option>
                            <option value="tanggal" {{ $filter == 'tanggal' ? 'selected' : '' }}>Pilih Tanggal</option>
                        </select>
                    </div>

                    <div id="tanggal-container" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Tanggal</label>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 flex items-center justify-center">
                            <i class="fas fa-search mr-2"></i>
                            Terapkan Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel laporan -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-table mr-2 text-blue-500"></i>
                    Data Laporan Penjualan
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Laporan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Transaksi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rentang Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penjualan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kerugian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keuntungan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($data as $row)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            @if(is_array($row))
                                @foreach($row as $col)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $col }}</td>
                                @endforeach
                            @else
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $row->id_laporan ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->tanggal_transaksi ? $row->tanggal_transaksi->format('d/m/Y') : 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $row->rentang_waktu ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600">Rp {{ number_format($row->total_penjualan ?? 0, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-red-600">Rp {{ number_format($row->kerugian ?? 0, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-blue-600">Rp {{ number_format($row->keuntungan ?? 0, 0, ',', '.') }}</td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500 text-sm">Tidak ada data laporan penjualan untuk filter yang dipilih</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Summary Footer -->
            @if($data->isNotEmpty())
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex justify-between items-center text-sm">
                    <span class="font-medium text-gray-700">Total Records: {{ $data->count() }}</span>
                    <div class="flex space-x-6">
                        <span class="text-green-600 font-semibold">Total Penjualan: Rp {{ number_format($data->sum('total_penjualan'), 0, ',', '.') }}</span>
                        <span class="text-red-600 font-semibold">Total Kerugian: Rp {{ number_format($data->sum('kerugian'), 0, ',', '.') }}</span>
                        <span class="text-blue-600 font-semibold">Total Keuntungan: Rp {{ number_format($data->sum('keuntungan'), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const rentangSelect = document.getElementById('rentang');
    const tanggalContainer = document.getElementById('tanggal-container');

    function toggleInputs() {
        const selectedValue = rentangSelect.value;

        // Hide all containers first
        tanggalContainer.classList.add('hidden');

        // Show relevant container based on selection
        if (selectedValue === 'tanggal') {
            tanggalContainer.classList.remove('hidden');
        }
    }

    // Initial check
    toggleInputs();

    // Listen for changes
    rentangSelect.addEventListener('change', toggleInputs);
});
</script>
@endsection
