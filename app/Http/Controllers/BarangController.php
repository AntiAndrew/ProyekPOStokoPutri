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
    $q = $request->q;              // keyword: id/nama
    $kategori = $request->kategori; // filter kategori

    $query = Barang::query();

    // Jika keyword dicari
    if ($q) {
        $query->where(function($x) use ($q) {
            $x->where('id_barang', 'LIKE', "%$q%")
              ->orWhere('nama_barang', 'LIKE', "%$q%");
        });
    }

    // Jika filter kategori dipilih
    if ($kategori) {
        $query->where('kategori', $kategori);
    }

    // Ambil hasil
    $hasil_pencarian = $query->get();

    // List kategori untuk dropdown
    $kategori_list = Barang::select('kategori')->distinct()->pluck('kategori');

    return view('barang.cari', [
        'hasil_pencarian' => $hasil_pencarian,
        'kategori'        => $kategori_list
    ]);
}

    public function edit($id)
    {   
    $barang = Barang::where('id_barang', $id)->first();

    if (!$barang) {
        return redirect()->back()->with('error', 'Barang tidak ditemukan!');
    }

    return view('barang.edit_form', compact('barang'));
}

public function manage() {
    $data_barang = Barang::all();
    return view('barang.manage', compact('data_barang'));
}

public function hapus() {
    $data_barang = Barang::all();
    return view('barang.hapus', compact('data_barang'));
}

}