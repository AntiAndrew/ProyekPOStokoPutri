@extends('layouts.dashboard')
@section('title', 'Edit Transaksi')

@section('content')
<div class="p-4 md:p-8 flex items-center justify-center min-h-screen relative">
    <div class="main-area w-full max-w-5xl p-6 md:p-8 bg-white shadow-lg rounded-xl">

        <h1 class="text-2xl font-bold text-gray-800 mb-4 text-center">
            ✏ Edit Transaksi
        </h1>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong class="font-bold">Oops!</strong>
                <span>Ada masalah pada input Anda.</span>
                <ul class="mt-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="edit-form" action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Ringkasan Transaksi --}}
            <div class="mb-4">
                <table class="w-full border-collapse">
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">ID Transaksi</th>
                        <th class="border p-2 text-left">Tanggal</th>
                        <th class="border p-2 text-left">Pegawai</th>
                    </tr>
                    <tr>
                        <td class="border p-2">
                            <input type="text" readonly
                                value="{{ $transaksi->id_transaksi }}"
                                class="w-full bg-gray-200 border p-1 rounded text-sm font-bold text-gray-700">
                        </td>
                        <td class="border p-2">
                            <input type="date" name="tanggal" required
                                value="{{ old('tanggal', \Carbon\Carbon::parse($transaksi->tanggal)->format('Y-m-d')) }}"
                                class="w-full border p-1 rounded text-sm">
                        </td>
                        <td class="border p-2">
                            <input type="text" readonly
                                value="{{ auth()->user()->name }}"
                                class="w-full bg-gray-200 border p-1 rounded text-sm font-medium text-gray-700">
                            <input type="hidden" name="id_pegawai" value="{{ auth()->user()->id }}">
                        </td>
                    </tr>
                </table>
            </div>

            {{-- Detail Barang --}}
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">
                    Detail Barang
                </h2>

                <table class="w-full border-collapse">
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">Nama Barang</th>
                        <th class="border p-2 text-left">Harga Satuan (Rp)</th>
                        <th class="border p-2 text-left">Jumlah</th>
                        <th class="border p-2 text-left">Subtotal</th>
                    </tr>
                    <tr>
                        <td class="border p-2">
                            <input type="text" name="nama_barang" required
                                value="{{ old('nama_barang', $transaksi->nama_barang) }}"
                                class="w-full border p-1 rounded text-sm">
                            <input type="hidden" name="id_barang" value="{{ $transaksi->id_barang }}">
                        </td>
                        <td class="border p-2">
                            <input type="number" id="harga_barang" name="harga_barang" min="0" required
                                value="{{ old('harga_barang', $transaksi->harga_barang) }}"
                                class="w-full border p-1 rounded text-sm">
                        </td>
                        <td class="border p-2">
                            <input type="number" id="jumlah_barang" name="jumlah_barang" min="1" required
                                value="{{ old('jumlah_barang', $transaksi->jumlah_barang) }}"
                                class="w-full border p-1 rounded text-sm">
                        </td>
                        <td class="border p-2 font-bold text-gray-700">
                            <span id="total_harga_display">
                                Rp {{ number_format($transaksi->total_harga,0,',','.') }}
                            </span>
                            <input type="hidden" name="total_harga" id="input_total_harga"
                                   value="{{ $transaksi->total_harga }}">
                        </td>
                    </tr>
                </table>
            </div>

            {{-- Footer --}}
            <div class="flex justify-center space-x-4 mt-4">
                <a href="{{ route('transaksi.index') }}"
                   class="bg-gray-200 text-gray-800 font-semibold px-6 py-2 rounded-lg shadow hover:bg-gray-300 transition">
                    Kembali
                </a>
                <button type="submit"
                        class="bg-primary text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-primaryDark transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const harga = document.getElementById('harga_barang');
    const jumlah = document.getElementById('jumlah_barang');
    const display = document.getElementById('total_harga_display');
    const inputTotal = document.getElementById('input_total_harga');

    function formatRp(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }

    function updateTotal() {
        const total = (harga.value || 0) * (jumlah.value || 0);
        display.textContent = 'Rp ' + formatRp(total);
        inputTotal.value = total;
    }

    harga.addEventListener('input', updateTotal);
    jumlah.addEventListener('input', updateTotal);
    updateTotal();
});
</script>
@endsection
