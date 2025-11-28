@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="container mx-auto p-6">

    @foreach ($data_barang as $item)
    <form action="{{ route('barang.update', $item->id_barang) }}" method="POST" class="row-form mb-3">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-7 gap-4 items-center">

            <label for="nama_barang">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ $item->nama_barang }}" class="input-inline">

            <label for="kategori">Kategori</label>
            <input type="text" id="kategori" name="kategori" value="{{ $item->kategori }}" class="input-inline">

            <label for="harga_barang">Harga Barang</label>
            <input type="number" id="harga_barang" name="harga_barang" value="{{ $item->harga_barang }}" class="input-inline">

            <label for="jumlah_barang">Jumlah Barang</label>
            <input type="number" id="jumlah_barang" name="jumlah_barang" value="{{ $item->jumlah_barang }}" class="input-inline">

            <div class="col-span-1 text-center">
                <button type="button"
                    class="btn-edit text-blue-500 hover:text-blue-700"
                    onclick="editRow(this)">✏️</button>

                <button type="submit"
                    class="btn-save text-green-600 font-bold hidden">✔️</button>
            </div>

        </div>
    </form>
    @endforeach
</div>

<script>
function editRow(btn) {
    let row = btn.closest(".row-form");
    let inputs = row.querySelectorAll("input");

    inputs.forEach(i => i.disabled = false);

    row.querySelector(".btn-edit").classList.add("hidden");
    row.querySelector(".btn-save").classList.remove("hidden");
}
</script>

@endsection
