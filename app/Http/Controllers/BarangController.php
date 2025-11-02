<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * READ: Menampilkan daftar semua barang (sesuai 'lihat_barang.php' Anda).
     * Route: GET /barang
     */
    public function index()
    {
        $data_barang = Barang::orderBy('nama_barang', 'asc')->get(); 
        
        // Menggunakan view yang menyajikan daftar barang dan tombol aksi (edit/hapus)
        return view('barang.index', compact('data_barang'));
    }

    /**
     * CREATE: Menampilkan formulir input barang (sesuai 'input_barang.php' Anda).
     * Route: GET /barang/create
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * STORE: Memproses data input dan menyimpan ke database.
     * Route: POST /barang
     */
    public function store(Request $request)
    {
        // 1. Validasi Input (WAJIB: Laravel otomatis mengamankan dari SQL Injection)
        $request->validate([
            'id_barang'   => 'required|unique:barang|max:50',
            'nama_barang' => 'required|max:255',
            'kategori'    => 'required|in:Makanan,Minuman,Alat rumah tangga', // Validasi kategori
            'harga'       => 'required|integer|min:0',
            'jumlah'      => 'required|integer|min:0',
        ]);
        
        // 2. Simpan ke database menggunakan Eloquent
        Barang::create($request->all());

        // 3. Redirect dengan pesan sukses
        return redirect()->route('barang.index')
                         ->with('success', '✅ Barang **' . $request->nama_barang . '** berhasil ditambahkan!');
    }

    /**
     * EDIT: Menampilkan formulir edit yang sudah terisi data.
     * Route: GET /barang/{barang}/edit
     */
    public function edit(Barang $barang) 
    {
        // Parameter $barang otomatis diisi oleh Laravel (Route Model Binding)
        return view('barang.edit', compact('barang'));
    }

    /**
     * UPDATE: Memproses update data yang dikirim dari form edit.
     * Route: PUT/PATCH /barang/{barang}
     */
    public function update(Request $request, Barang $barang)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_barang' => 'required|max:255',
            'kategori'    => 'required|in:Makanan,Minuman,Alat rumah tangga',
            'harga'       => 'required|integer|min:0',
            'jumlah'      => 'required|integer|min:0',
        ]);

        // 2. Update data
        $barang->update($request->all());

        // 3. Redirect
        return redirect()->route('barang.index')
                         ->with('success', '♻️ Barang **' . $request->nama_barang . '** berhasil diperbarui!');
    }

    /**
     * DESTROY: Menghapus data barang.
     * Route: DELETE /barang/{barang}
     */
    public function destroy(Barang $barang)
    {
        $nama = $barang->nama_barang;
        $barang->delete();

        return redirect()->route('barang.index')
                         ->with('success', '🗑️ Barang **' . $nama . '** berhasil dihapus!');
    }
    
    /**
     * CARI: Metode tambahan untuk pencarian (sesuai 'cari_barang.php' Anda).
     * Route: GET /barang/cari
     */
    public function cari(Request $request)
    {
        $keyword = $request->input('q');
        
        $data_barang = Barang::where('nama_barang', 'like', "%{$keyword}%")
                             ->orWhere('id_barang', 'like', "%{$keyword}%")
                             ->get();
        
        // Asumsi View: resources/views/barang/cari.blade.php
        return view('barang.cari', compact('data_barang', 'keyword'));
    }
}