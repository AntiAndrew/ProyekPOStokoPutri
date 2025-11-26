<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator; // Tambahkan untuk validasi

class BarangController extends Controller
{
    public function menu()
    {
        return view('barang.menu_kelola_barang');
    }

    public function index()
    {
        $data_barang = Barang::all();
        return view('barang.index', compact('data_barang'));
    }

    public function create()
    {
        $nextId = 'A.01';
        return view('barang.create', compact('nextId'));
    }

    public function store(Request $request)
    {
        Barang::create([
            'id_barang'     => $request->id_barang,
            'nama_barang'   => $request->nama_barang,
            'kategori'      => $request->kategori,
            'harga_barang'  => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil disimpan!');
    }

    public function manage(Request $request)
    {
        $data_barang = Barang::all();
        $mode = $request->query('mode', 'edit');
        return view('barang.manage', compact('data_barang', 'mode'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::where('id_barang', $id)->first();

        $barang->nama_barang   = $request->nama_barang;
        $barang->kategori      = $request->kategori;
        $barang->harga_barang  = $request->harga_barang;
        $barang->jumlah_barang = $request->jumlah_barang;

        $barang->save();

        return back()->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::where('id_barang', $id)->first();

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan.');
        }

        $barang->delete();

        return back()->with('success', 'Barang berhasil dihapus!');
    }

    public function cari(Request $request)
    {
        $kategori = ['Terbaru', 'Terlaris', 'Sembako', 'Perlengkapan Kos', 'Aksesoris', 'Kecantikan'];
        $hasil_pencarian = [];

        return view('barang.cari', compact('kategori', 'hasil_pencarian'));
    }

    public function edit($id)
    {   
    $barang = Barang::where('id_barang', $id)->first();

    if (!$barang) {
        return redirect()->back()->with('error', 'Barang tidak ditemukan!');
    }

    return view('barang.edit', compact('barang'));
}
}