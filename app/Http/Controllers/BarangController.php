<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator; // Tambahkan untuk validasi

class BarangController extends Controller
{
    /**
     * Menampilkan menu utama Kelola Barang.
     */
    public function menu()
    {
        return view('barang.menu_kelola_barang');
    }

    /**
     * Menampilkan halaman Lihat Daftar Barang (Index).
     */
    public function index()
    {
        // Ambil semua data barang untuk ditampilkan (atau dengan pagination)
        $data_barang = Barang::all();

        return view('barang.index', compact('data_barang'));
    }

    /**
     * Menampilkan form Input Barang (Create).
     */
    public function create()
    {
        // Untuk demo, kita dapat memberikan ID barang placeholder.
        // Dalam aplikasi nyata, ID ini biasanya di-generate oleh database atau sistem.
        $nextId = 'A.01'; 
        return view('barang.create', compact('nextId'));
    }

    /**
     * Menyimpan data Barang baru ke database (Store).
     */
    public function store(Request $request)
    {
        // 1. Validasi Data
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            // Tambahkan aturan validasi lain sesuai kebutuhan model Barang Anda
        ]);

        if ($validator->fails()) {
            // Kembali ke form dengan input sebelumnya dan pesan error
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // 2. Simpan Data Baru
            Barang::create([
                'nama' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
                // Tambahkan field lain
            ]);

            // 3. Redirect dengan pesan sukses
            return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan!');

        } catch (\Exception $e) {
             // Tangani error database jika terjadi
             return redirect()->back()->with('error', 'Gagal menyimpan data barang. Silakan coba lagi.');
        }
    }


    /**
     * Menampilkan halaman Edit/Hapus Barang (Manage).
     */
    public function manage(Request $request)
    {
        // Ambil semua data barang untuk ditampilkan
        $data_barang = Barang::all();

        // Menentukan mode tampilan (Edit atau Hapus)
        $mode = $request->query('mode', 'edit'); // Default ke 'edit'

        return view('barang.manage', compact('data_barang', 'mode'));
    }
    
    /**
     * Memperbarui data Barang yang sudah ada (Update).
     * @param Request $request
     * @param string $id ID Barang yang akan diupdate.
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // 1. Validasi Data
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // 2. Perbarui Data
            $barang->update([
                'nama' => $request->nama_barang,
                'harga' => $request->harga,
                'stok' => $request->stok,
                // Tambahkan field lain
            ]);

            // 3. Redirect dengan pesan sukses
            return redirect()->route('barang.manage', ['mode' => 'edit'])->with('success', 'Data barang berhasil diperbarui!');

        } catch (\Exception $e) {
             return redirect()->back()->with('error', 'Gagal memperbarui data barang. Silakan coba lagi.');
        }
    }

    /**
     * Menghapus data Barang tertentu (Destroy).
     * @param string $id ID Barang yang akan dihapus.
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        try {
            // Hapus data
            $barang->delete();

            return redirect()->route('barang.manage', ['mode' => 'delete'])->with('success', 'Data barang berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data barang. Silakan coba lagi.');
        }
    }


    /**
     * Menampilkan halaman Cari Barang.
     */
    public function cari()
    {
        // Placeholder data untuk kategori dan hasil pencarian
        $kategori = ['Terbaru', 'Terlaris', 'Sembako', 'Perlengkapan Kos', 'Aksesoris', 'Kecantikan'];
        // Hasil pencarian awal kosong
        $hasil_pencarian = [];

        return view('barang.cari', compact('kategori', 'hasil_pencarian'));
    }
}