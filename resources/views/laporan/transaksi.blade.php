@extends('layouts.dashboard')
@section('title', 'Laporan Transaksi')
@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-pastel-dark mb-6 text-center">Laporan Transaksi</h2>

        <!-- Filter rentang waktu -->
        <form method="GET" action="{{ route('laporan.transaksi') }}" class="mb-6">
            <h4 class="text-lg font-semibold text-pastel-dark mb-4">Rentang Waktu</h4>
            <div class="flex flex-wrap gap-4 mb-4">
                <label class="flex items-center">
                    <input type="radio" name="rentang" value="hari_ini" {{ $filter == 'hari_ini' ? 'checked' : '' }} class="mr-2 text-pastel-green">
                    <span>Hari Ini</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="rentang" value="7_hari" {{ $filter == '7_hari' ? 'checked' : '' }} class="mr-2 text-pastel-green">
                    <span>7 Hari Terakhir</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="rentang" value="bulan" {{ $filter == 'bulan' ? 'checked' : '' }} class="mr-2 text-pastel-green">
                    <span>Pilih Bulan</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" name="rentang" value="tanggal" {{ $filter == 'tanggal' ? 'checked' : '' }} class="mr-2 text-pastel-green">
                    <span>Pilih Tanggal</span>
                </label>
            </div>
            <button type="submit" class="bg-pastel-green hover:bg-pastel-green/80 text-white font-bold py-2 px-4 rounded transition duration-150">
                Filter
            </button>
        </form>

        <!-- Konten utama -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Sidebar -->
            <div class="md:col-span-1">
                <div class="bg-pastel-accent rounded-lg p-4">
                    <button onclick="window.location.href='{{ route('laporan.transaksi') }}'"
                            class="w-full bg-pastel-green hover:bg-pastel-green/80 text-white font-bold py-2 px-4 rounded mb-4 transition duration-150">
                        Laporan Transaksi
                    </button>
                    <button onclick="window.location.href='{{ route('logout') }}'"
                            class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-150">
                        Logout
                    </button>
                </div>
            </div>

            <!-- Main content -->
            <div class="md:col-span-2">
                <div class="bg-pastel-accent rounded-lg p-6 text-center shadow-lg transition duration-200 hover:shadow-xl">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135695.png" alt="icon laporan" class="w-16 h-16 mx-auto mb-4">
                    <a href="{{ route('laporan.penjualan') }}"
                       class="inline-block bg-pastel-green hover:bg-pastel-green/80 text-white font-bold py-2 px-6 rounded transition duration-150">
                        Laporan Penjualan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
