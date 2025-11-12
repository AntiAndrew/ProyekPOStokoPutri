@extends('layouts.app')
@section('title','Input Transaksi')

@section('content')
<div class="form-page">
  <div class="form-container">
    <h2 class="page-title">Input Transaksi</h2>

    <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
      @csrf
      <div class="form-group">
        <label for="no_transaksi">No Transaksi</label>
        <input type="text" id="no_transaksi" name="no_transaksi" value="{{ $no }}" readonly>
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
      </div>
      <div class="form-group">
        <label for="pelanggan">Pelanggan</label>
        <input type="text" id="pelanggan" name="pelanggan" value="">
      </div>

      <hr class="my-4">

      {{-- Area item dinamis --}}
      <div id="itemsArea">
        <div class="item-row grid grid-cols-12 gap-2 items-center mb-2">
          <div class="col-span-4">
            <input type="text" name="items[0][id_barang]" placeholder="Kode Barang (A.01)" class="w-full" required>
          </div>
          <div class="col-span-4">
            <input type="text" name="items[0][nama_barang]" placeholder="Nama Barang" class="w-full" required>
          </div>
          <div class="col-span-2">
            <input type="number" name="items[0][jumlah]" placeholder="Jumlah" min="1" value="1" required>
          </div>
          <div class="col-span-2">
            <input type="number" name="items[0][harga_satuan]" placeholder="Harga" min="0" step="0.01" value="0" required>
          </div>
        </div>
      </div>

      <div class="flex gap-2 mb-4">
        <button type="button" id="btnAddItem" class="btn-cancel">Tambah Item</button>
        <button type="button" id="btnRemoveItem" class="btn-reset">Hapus Item</button>
      </div>

      <div class="form-group">
        <label for="diskon">Diskon (Rp)</label>
        <input type="number" id="diskon" name="diskon" value="0" min="0" step="0.01">
      </div>

      <div class="form-btn-bottom">
        <a href="{{ route('transaksi.menu') }}" class="btn-cancel">Kembali</a>
        <button type="submit" class="btn-save">Simpan Transaksi</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
  let idx = 1;
  document.getElementById('btnAddItem').addEventListener('click', () => {
    const container = document.getElementById('itemsArea');
    const row = document.createElement('div');
    row.className = 'item-row grid grid-cols-12 gap-2 items-center mb-2';
    row.innerHTML = `
      <div class="col-span-4"><input type="text" name="items[${idx}][id_barang]" placeholder="Kode Barang" class="w-full" required></div>
      <div class="col-span-4"><input type="text" name="items[${idx}][nama_barang]" placeholder="Nama Barang" class="w-full" required></div>
      <div class="col-span-2"><input type="number" name="items[${idx}][jumlah]" placeholder="Jumlah" min="1" value="1" required></div>
      <div class="col-span-2"><input type="number" name="items[${idx}][harga_satuan]" placeholder="Harga" min="0" step="0.01" value="0" required></div>
    `;
    container.appendChild(row);
    idx++;
  });

  document.getElementById('btnRemoveItem').addEventListener('click', () => {
    const container = document.getElementById('itemsArea');
    if (container.children.length > 1) container.removeChild(container.lastElementChild);
  });

  // optional: prevent double submit
  document.getElementById('formTransaksi').addEventListener('submit', function(e){
    this.querySelector('button[type="submit"]').disabled = true;
  });
</script>
@endpush
@endsection
