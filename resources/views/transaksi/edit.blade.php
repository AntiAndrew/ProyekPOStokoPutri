@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
    .screen-area {
        max-width: 1200px;
        margin: 30px auto;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
        font-family: 'Inter', sans-serif;
    }
    .input-table th, .input-table td {
        padding: 10px;
        border: 1px solid #e5e7eb;
    }
    .input-table th { background-color: #f3f4f6; text-align: left; }
    .input-table input[type="number"], .input-table select {
        width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 4px;
    }
    .input-table input:focus, .input-table select:focus {
        border-color: #3b82f6; outline: none; box-shadow: 0 0 0 1px #3b82f6;
    }
</style>

<div class="screen-area">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">
        Edit Transaksi ({{ $transaksi->no_ref ?? 'TRX-' . $transaksi->id }})
    </h1>

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Header --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-gray-50 p-6 rounded-lg border">
            <div>
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Transaksi</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($transaksi->tanggal)->format('Y-m-d')) }}" required
                       class="w-full p-2 border border-gray-300 rounded-lg focus:border-blue-500">
                @error('tanggal')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="pelanggan" class="block text-sm font-medium text-gray-700 mb-1">Pelanggan</label>
                <input type="text" name="pelanggan" id="pelanggan" value="{{ old('pelanggan', $transaksi->pelanggan ?? 'Umum') }}"
                       class="w-full p-2 border border-gray-300 rounded-lg focus:border-blue-500">
            </div>
        </div>

        {{-- Detail Item --}}
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Detail Item Transaksi</h2>
        <div class="overflow-x-auto mb-6">
            <table class="input-table w-full whitespace-nowrap">
                <thead>
                    <tr>
                        <th class="w-1/12">No.</th>
                        <th class="w-4/12">Produk</th>
                        <th class="w-1/12 text-center">Qty</th>
                        <th class="w-2/12">Harga Satuan (Rp)</th>
                        <th class="w-1/12">Diskon (%)</th>
                        <th class="w-2/12">Subtotal (Rp)</th>
                        <th class="w-1/12 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="item-list">
                    @foreach($transaksi->items as $index => $item)
                    <tr data-index="{{ $index }}">
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <select name="items[{{ $index }}][barang_id]" required class="item-select w-full p-2 border border-gray-300 rounded-lg">
                                <option value="">Pilih Barang</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}" data-harga="{{ $b->harga_jual }}"
                                        {{ $b->id == $item->barang_id ? 'selected' : '' }}>
                                        {{ $b->nama_barang }} ({{ $b->kode_barang }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center">
                            <input type="number" name="items[{{ $index }}][qty]" value="{{ old("items.$index.qty", $item->qty) }}" min="1" class="qty-input w-full text-center">
                        </td>
                        <td>
                            <input type="number" name="items[{{ $index }}][harga_satuan]" value="{{ old("items.$index.harga_satuan", $item->harga_satuan) }}" min="0" class="harga-input w-full text-right bg-gray-100" readonly>
                        </td>
                        <td>
                            <input type="number" name="items[{{ $index }}][diskon_persen]" value="{{ old("items.$index.diskon_persen", $item->diskon_persen) }}" min="0" max="100" class="diskon-input w-full text-center">
                        </td>
                        <td class="text-right subtotal-cell font-medium">
                            {{ number_format($item->subtotal,0,',','.') }}
                            <input type="hidden" name="items[{{ $index }}][subtotal]" value="{{ $item->subtotal }}" class="subtotal-hidden">
                        </td>
                        <td class="text-center">
                            <button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-800 font-bold">&times;</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right font-bold text-lg bg-gray-100">Total Transaksi</td>
                        <td id="grand-total-display" class="text-right font-extrabold text-xl bg-gray-100 text-blue-600">
                            {{ number_format($transaksi->total ?? 0,0,',','.') }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <button type="button" onclick="addItem()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition mb-8">
            + Tambah Item
        </button>

        <div class="flex justify-end gap-4 mt-8 pt-4 border-t">
            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Batal
            </a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
let itemIndex = {{ $transaksi->items->count() }};
const barangData = @json($barang);

document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.item-select').forEach(s => s.addEventListener('change', handleItemChange));
    document.querySelectorAll('.qty-input, .diskon-input').forEach(i => i.addEventListener('input', handleItemChange));
    // Update harga awal
    document.querySelectorAll('.item-select').forEach(s => updateHarga(s));
    calculateGrandTotal();
});

function handleItemChange(e){
    if(e.target.classList.contains('item-select')) updateHarga(e.target);
    calculateSubtotal(e.target.closest('tr'));
}

function updateHarga(select){
    const row = select.closest('tr');
    const hargaInput = row.querySelector('.harga-input');
    const selected = select.options[select.selectedIndex];
    hargaInput.value = selected.value ? selected.getAttribute('data-harga') : 0;
    calculateSubtotal(row);
}

function addItem(){
    const list = document.getElementById('item-list');
    const row = document.createElement('tr');
    row.dataset.index = itemIndex;

    let options = '<option value="">Pilih Barang</option>';
    barangData.forEach(b => {
        options += `<option value="${b.id}" data-harga="${b.harga_jual}">${b.nama_barang} (${b.kode_barang})</option>`;
    });

    row.innerHTML = `
        <td>${itemIndex+1}</td>
        <td><select name="items[${itemIndex}][barang_id]" required class="item-select w-full p-2 border border-gray-300 rounded-lg">${options}</select></td>
        <td class="text-center"><input type="number" name="items[${itemIndex}][qty]" value="1" min="1" class="qty-input w-full text-center"></td>
        <td><input type="number" name="items[${itemIndex}][harga_satuan]" value="0" min="0" class="harga-input w-full text-right bg-gray-100" readonly></td>
        <td><input type="number" name="items[${itemIndex}][diskon_persen]" value="0" min="0" max="100" class="diskon-input w-full text-center"></td>
        <td class="text-right subtotal-cell font-medium">0<input type="hidden" name="items[${itemIndex}][subtotal]" value="0" class="subtotal-hidden"></td>
        <td class="text-center"><button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-800 font-bold">&times;</button></td>
    `;

    list.appendChild(row);

    // Bind event
    row.querySelector('.item-select').addEventListener('change', e => updateHarga(e.target));
    row.querySelector('.qty-input').addEventListener('input', e => calculateSubtotal(e.target.closest('tr')));
    row.querySelector('.diskon-input').addEventListener('input', e => calculateSubtotal(e.target.closest('tr')));

    itemIndex++;
}

function removeItem(btn){
    btn.closest('tr').remove();
    updateRowNumbers();
    calculateGrandTotal();
}

function updateRowNumbers(){
    document.querySelectorAll('#item-list tr').forEach((r,i)=> r.querySelector('td:first-child').textContent = i+1);
}

function calculateSubtotal(row){
    const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
    const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
    const diskon = parseFloat(row.querySelector('.diskon-input').value) || 0;
    const subtotal = harga * qty * (1 - diskon/100);
    row.querySelector('.subtotal-cell').textContent = formatRupiah(subtotal);
    row.querySelector('.subtotal-hidden').value = subtotal.toFixed(2);
    calculateGrandTotal();
}

function calculateGrandTotal(){
    let total = 0;
    document.querySelectorAll('.subtotal-hidden').forEach(h => total += parseFloat(h.value)||0);
    document.getElementById('grand-total-display').textContent = formatRupiah(total);
}

function formatRupiah(num){ return num.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g,"."); }
</script>
@endsection
