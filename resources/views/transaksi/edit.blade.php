@extends('layouts.app')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>
{{-- ... (STYLE CSS LENGKAP SEBELUMNYA) ... --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background-color: #e6f7ff; 
    }
    .main-area {
        background-color: #f0fff0; 
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        padding-bottom: 100px; 
        min-height: 85vh;
    }
    
    /* Header Transaksi Styling */
    .transaction-summary {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        border: 1px solid #e0e0e0;
    }

    /* --- Tabel Item Styling Utama --- */
    .input-table {
        width: 100%;
        border-collapse: separate; 
        border-spacing: 0 8px; 
    }
    
    /* Header (Thead) */
    .input-table thead {
        border-radius: 8px;
        overflow: hidden; 
        display: table; 
        width: 100%;
        table-layout: fixed;
        margin-bottom: 0px; 
    }
    .input-table thead th {
        background-color: #8c8c8c; 
        color: white;
        text-align: center;
        font-weight: 600;
        padding: 10px 5px;
        text-transform: capitalize;
        border-bottom: 1px solid #7a7a7a; 
    }
    .input-table thead th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 0px; } 
    .input-table thead th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 0px; } 

    /* Baris Item (Tbody) */
    .input-table tbody {
        display: block; 
        width: 100%;
        margin-top: -1px; 
    }
    .input-table tbody tr {
        display: table; 
        width: 100%;
        table-layout: fixed;
        background-color: #fff; 
        border-radius: 5px; 
        box-shadow: 0 1px 3px rgba(0,0,0,0.08); 
        border: 1px solid #e0e0e0; 
        padding: 0; 
    }
    
    /* Sel Tabel (TD) */
    .table-row-style td {
        padding: 0; 
        vertical-align: middle;
        height: 48px; 
        display: table-cell; 
        position: relative;
        border-top: none !important;
        border: none !important; 
    }

    /* --- Styling Box Input --- */
    .item-input-box {
        height: 100%; 
        border-radius: 0px; 
        font-size: 14px;
        display: flex;
        align-items: center;
        width: 100%;
        box-sizing: border-box;
        padding: 8px 12px; 
        background-color: #d8d8d8; 
        color: #333;
        font-weight: 500;
        border: none;
    }

    /* Kotak Khusus untuk Nomor Urut */
    .no-box {
        background-color: #d8d8d8; 
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        color: #333;
        font-weight: 500;
        font-size: 14px;
        border-right: 1px solid #c0c0c0; 
    }

    /* Select untuk Nama Barang */
    .item-select {
        background-color: #d8d8d8; 
        border: none; 
        color: #333;
        appearance: none; 
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.7rem center;
        background-size: 0.8em 0.8em;
    }
    
    /* Input Jumlah (Warna Putih) */
    .qty-input {
        background-color: #fff;
        border: none; 
        text-align: center;
        padding: 0 12px; 
        -moz-appearance: textfield; 
        color: #333;
        font-weight: 500;
    }
    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Tombol Hapus */
    .remove-item-box {
        background-color: #ef4444; 
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    .remove-item-btn {
        background: none;
        color: white;
        border: none;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
    .remove-item-box:hover {
        background-color: #dc2626;
    }

    /* Border dan Radius */
    .table-row-style td:nth-child(1) .no-box { 
        border-top-left-radius: 0; 
        border-bottom-left-radius: 5px; 
    }
    .table-row-style td:nth-child(2) .item-input-box { border-left: 1px solid #c0c0c0; border-right: 1px solid #c0c0c0; }
    .table-row-style td:nth-child(3) .item-select { border-right: 1px solid #c0c0c0; }
    .table-row-style td:nth-child(4) .item-input-box { border-right: 1px solid #c0c0c0; }
    .table-row-style td:nth-child(5) .qty-input { border-right: 1px solid #c0c0c0; border-left: 1px solid #c0c0c0; background-color: white; }
    .table-row-style td:nth-child(6) .remove-item-box { 
        border-top-right-radius: 0; 
        border-bottom-right-radius: 5px; 
    }

    /* Styling input tanggal dan pelanggan di header */
    .header-input {
        background-color: #fff;
        border: 1px solid #d1d5db;
        padding: 8px;
        border-radius: 5px;
        font-size: 14px;
        height: 38px;
        width: 100%;
    }
</style>

<div class="p-4 md:p-8 flex items-center justify-center min-h-screen">
    <div class="main-area w-full max-w-4xl p-6 md:p-10">

        {{-- Top Navigation Bar --}}
        <div class="flex items-center justify-between mb-8 md:mb-10">
            <div class="flex items-center space-x-2">
                <a href="{{ route('transaksi.show', $transaksi->id) }}" class="text-gray-600 hover:text-gray-800 p-2 rounded-full bg-white shadow-md hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <a href="{{ route('transaksi.menu') }}" class="text-gray-600 hover:text-gray-800 p-2 rounded-full bg-white shadow-md hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path></svg>
                </a>
            </div>

            <h1 class="text-3xl font-bold text-center text-gray-800 flex-grow">Edit Transaksi</h1>
            
            <a href="#" class="text-gray-600 hover:text-gray-800 p-2 rounded-full bg-white shadow-md hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </a>
        </div>
        
        <form id="edit-form" action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Ringkasan Data Transaksi --}}
            <div class="transaction-summary grid grid-cols-4 gap-4 mb-8 text-sm text-gray-700">
                <div>
                    <span class="font-semibold block uppercase text-xs text-gray-500 mb-1">NO. TRANSAKSI</span>
                    <span class="font-bold text-lg text-gray-800">{{ $transaksi->no_transaksi }}</span>
                    <input type="hidden" name="no_transaksi" value="{{ $transaksi->no_transaksi }}">
                </div>
                <div>
                    <span class="font-semibold block uppercase text-xs text-gray-500 mb-1">TANGGAL</span>
                    <input type="date" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($transaksi->tanggal)->format('Y-m-d')) }}" required
                        class="header-input w-full">
                </div>
                <div>
                    <span class="font-semibold block uppercase text-xs text-gray-500 mb-1">PELANGGAN</span>
                    <input type="text" name="pelanggan" value="{{ old('pelanggan', $transaksi->pelanggan ?? 'Umum') }}"
                        class="header-input w-full">
                </div>
                <div>
                    <span class="font-semibold block uppercase text-xs text-gray-500 mb-1">TOTAL AKHIR (Rp)</span>
                    <span id="grand-total-display" class="font-bold text-xl text-green-600">
                        {{ number_format($transaksi->total, 0, ',', '.') }}
                    </span>
                    <input type="hidden" name="total_hidden" id="total-hidden-input" value="{{ $transaksi->total }}">
                </div>
                <input type="hidden" name="salesman" value="{{ $transaksi->salesman ?? 'Anonim' }}">
                <input type="hidden" name="bayar" value="{{ $transaksi->bayar ?? $transaksi->total }}">
            </div>

            {{-- Detail Item Table --}}
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Detail Item</h2>
            <div class="overflow-x-auto mb-4">
                <table class="input-table">
                    <thead>
                        <tr>
                            <th class="w-[5%]">No</th>
                            <th class="w-[15%]">ID</th>
                            <th class="w-[30%]">Nama Barang</th>
                            <th class="w-[15%]">Harga Satuan</th>
                            <th class="w-[15%]">Jumlah</th>
                            <th class="w-[10%]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="item-list">
                        @foreach($transaksi->items as $index => $item)
                        <tr data-index="{{ $index }}" class="table-row-style">
                            {{-- Kolom No. --}}
                            <td>
                                <div class="no-box">
                                    {{ $index + 1 }}
                                </div>
                            </td> 
                            
                            {{-- Kolom ID (Grey Box) --}}
                            <td>
                                <div class="item-input-box">
                                    <span class="text-sm font-medium">{{ $item->id_barang }}</span>
                                </div>
                                <input type="hidden" name="items[{{ $index }}][id_barang]" value="{{ $item->id_barang }}">
                                <input type="hidden" name="items[{{ $index }}][nama_barang]" value="{{ $item->nama_barang }}">
                            </td>
                            
                            {{-- Kolom Nama Barang (Grey Select) --}}
                            <td>
                                <select name="items[{{ $index }}][barang_id]" required class="item-select item-input-box text-sm">
                                    <option value="">Pilih Barang</option>
                                    @foreach($barang as $b)
                                        <option value="{{ $b->id }}" 
                                                data-id_barang="{{ $b->id_barang }}"
                                                data-nama_barang="{{ $b->nama_barang }}"
                                                data-harga="{{ $b->harga_jual }}"
                                                {{ $b->id_barang == $item->id_barang ? 'selected' : '' }}>
                                            {{ $b->nama_barang }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            
                            {{-- Kolom Harga Satuan (Grey Box) --}}
                            <td>
                                <div class="item-input-box justify-end">
                                    <span class="harga-display text-sm">{{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                                </div>
                                <input type="hidden" name="items[{{ $index }}][harga_satuan]" 
                                       value="{{ old("items.$index.harga_satuan", $item->harga_satuan) }}" 
                                       class="harga-input">
                                <input type="hidden" name="items[{{ $index }}][diskon_persen]" value="0">
                            </td>
                            
                            {{-- Kolom Jumlah (White Input) --}}
                            <td>
                                <input type="number" name="items[{{ $index }}][jumlah]" 
                                       value="{{ old("items.$index.jumlah", $item->jumlah) }}" 
                                       min="1" class="qty-input item-input-box text-sm">
                            </td>
                            
                            {{-- Kolom Aksi --}}
                            <td>
                                <div class="remove-item-box">
                                    <button type="button" onclick="removeItem(this)" class="remove-item-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                            <input type="hidden" name="items[{{ $index }}][subtotal]" value="{{ $item->subtotal }}" class="subtotal-hidden">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Tambah Item (Button) --}}
            <div class="flex justify-start mb-16">
                <button type="button" onclick="addItem()" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md hover:bg-indigo-700 transition">
                    + Tambah Item
                </button>
            </div>

        </form>

        {{-- Footer Buttons --}}
        <div class="absolute bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-200 flex justify-center space-x-8 rounded-b-xl">
            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="bg-gray-200 text-gray-800 font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-gray-300 transition">
                Kembali
            </a>
            <button type="submit" form="edit-form" class="bg-green-600 text-white font-semibold px-8 py-3 rounded-lg shadow-lg hover:bg-green-700 transition">
                Simpan
            </button>
        </div>

    </div>
</div>

{{-- SCRIPT JAVASCRIPT LENGKAP --}}
<script>
let itemIndex = {{ $transaksi->items->count() }};
const barangData = @json($barang); 

document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('#item-list tr').forEach(row => {
        setupRowListeners(row);
        calculateSubtotal(row); 
    });
    calculateGrandTotal(); 
});

function setupRowListeners(row) {
    // Pastikan listener dipasang pada elemen yang benar
    const select = row.querySelector('.item-select');
    const qtyInput = row.querySelector('.qty-input');

    if (select) select.addEventListener('change', handleItemChange);
    if (qtyInput) qtyInput.addEventListener('input', handleItemChange);
}

function handleItemChange(e){
    const row = e.target.closest('tr');
    if(e.target.classList.contains('item-select')) {
        updateItemDetails(row, e.target);
    }
    calculateSubtotal(row);
}

function updateItemDetails(row, select){
    const selectedOption = select.options[select.selectedIndex];
    const hargaInput = row.querySelector('.harga-input');
    // Cari span harga di dalam td ke-4 (Harga Satuan)
    const hargaDisplay = row.querySelector('td:nth-child(4) .item-input-box span'); 
    const idBarangHidden = row.querySelector('input[name*="[id_barang]"]');
    const namaBarangHidden = row.querySelector('input[name*="[nama_barang]"]');
    // Cari span ID di dalam td ke-2 (ID)
    const idCellSpan = row.querySelector('td:nth-child(2) .item-input-box span'); 

    if (selectedOption.value) {
        const harga = selectedOption.getAttribute('data-harga');
        const idBarang = selectedOption.getAttribute('data-id_barang');
        const namaBarang = selectedOption.getAttribute('data-nama_barang');

        hargaInput.value = harga;
        hargaDisplay.textContent = formatRupiah(harga);
        idBarangHidden.value = idBarang;
        namaBarangHidden.value = namaBarang;
        idCellSpan.textContent = idBarang;
    } else {
        hargaInput.value = 0;
        hargaDisplay.textContent = '0';
        idBarangHidden.value = '';
        namaBarangHidden.value = '';
        idCellSpan.textContent = 'N/A';
    }
}

function addItem(){
    const list = document.getElementById('item-list');
    const newIndex = itemIndex;

    const row = document.createElement('tr');
    row.dataset.index = newIndex;
    row.classList.add('table-row-style');

    let options = '<option value="">Pilih Barang</option>';
    barangData.forEach(b => {
        options += `<option value="${b.id}" data-id_barang="${b.id_barang}" data-nama_barang="${b.nama_barang}" data-harga="${b.harga_jual}">${b.nama_barang}</option>`;
    });

    row.innerHTML = `
        <td>
            <div class="no-box">
                ${newIndex + 1}
            </div>
        </td>
        <td>
            <div class="item-input-box">
                <span class="text-sm font-medium">N/A</span>
            </div>
            <input type="hidden" name="items[${newIndex}][id_barang]" value="">
            <input type="hidden" name="items[${newIndex}][nama_barang]" value="">
        </td>
        <td>
            <select name="items[${newIndex}][barang_id]" required class="item-select item-input-box text-sm">${options}</select>
        </td>
        <td>
            <div class="item-input-box justify-end">
                <span class="harga-display text-sm">0</span>
            </div>
            <input type="hidden" name="items[${newIndex}][harga_satuan]" value="0" class="harga-input">
            <input type="hidden" name="items[${newIndex}][diskon_persen]" value="0">
        </td>
        <td>
            <input type="number" name="items[${newIndex}][jumlah]" value="1" min="1" class="qty-input item-input-box text-sm">
        </td>
        <td>
            <div class="remove-item-box">
                <button type="button" onclick="removeItem(this)" class="remove-item-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        </td>
        <input type="hidden" name="items[${newIndex}][subtotal]" value="0" class="subtotal-hidden">
    `;

    list.appendChild(row);

    setupRowListeners(row);
    itemIndex++;
    updateRowNames();
}

function removeItem(btn){
    btn.closest('tr').remove();
    updateRowNames();
    updateRowNumbers();
    calculateGrandTotal();
}

function updateRowNumbers(){
    document.querySelectorAll('#item-list tr').forEach((r,i)=> r.querySelector('td:first-child .no-box').textContent = i+1);
}

function updateRowNames() {
    document.querySelectorAll('#item-list tr').forEach((row, index) => {
        row.dataset.index = index;
        const inputs = row.querySelectorAll('input, select');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                input.setAttribute('name', name.replace(/\[\d+\]/, `[${index}]`));
            }
        });
    });
}

function calculateSubtotal(row){
    const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
    const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
    const diskonPersen = 0; 
    
    const subtotal = harga * qty * (1 - diskonPersen / 100);
    
    row.querySelector('.subtotal-hidden').value = subtotal.toFixed(2);
    
    calculateGrandTotal();
}

function calculateGrandTotal(){
    let total = 0;
    document.querySelectorAll('.subtotal-hidden').forEach(h => total += parseFloat(h.value)||0);
    
    document.getElementById('grand-total-display').textContent = formatRupiah(total.toFixed(0));
    document.getElementById('total-hidden-input').value = total.toFixed(2);
}

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID').format(number);
}

</script>
@endsection