<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

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

    // =====================
    // CREATE
    // =====================
    public function create()
    {
        return view('barang.create');
    }

    // =====================
    // STORE + VALIDATION
    // =====================
    public function store(Request $request)
    {
        // VALIDASI
        $validator = Validator::make($request->all(), [
            'id_barang' => [
                'required',
                'regex:/^[A-Z][0-9]{2}$/',      // Format A + 2 angka seperti A01
                'unique:barang,id_barang'       // Harus unik di DB
            ],
            'nama_barang'   => 'required|string|max:100',
            'kategori'      => 'required',
            'harga_barang'  => 'required|numeric|min:0',
            'jumlah_barang' => 'required|integer|min:0',
        ], [
            'id_barang.required' => 'ID Barang wajib diisi!',
            'id_barang.regex'    => 'Format ID Barang salah! Contoh: A01',
            'id_barang.unique'   => 'ID Barang sudah ada, gunakan yang lain!',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // SIMPAN DATA
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

    // =====================
    // EDIT
    // =====================
    public function edit($id)
    {
        $barang = Barang::where('id_barang', $id)->first();

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan!');
        }

        return view('barang.edit_form', compact('barang'));
    }

    // =====================
    // UPDATE
    // =====================
    public function update(Request $request, $id)
    {
        $barang = Barang::where('id_barang', $id)->first();

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan!');
        }

        // VALIDASI UPDATE
        $validator = Validator::make($request->all(), [
            'nama_barang'   => 'required|string|max:100',
            'kategori'      => 'required',
            'harga_barang'  => 'required|numeric|min:0',
            'jumlah_barang' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $barang->update([
            'nama_barang'   => $request->nama_barang,
            'kategori'      => $request->kategori,
            'harga_barang'  => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
        ]);

        return back()->with('success', 'Barang berhasil diperbarui!');
    }

    // =====================
    // DELETE
    // =====================
    public function destroy($id)
    {
        $barang = Barang::where('id_barang', $id)->first();

        if (!$barang) {
            return back()->with('error', 'Barang tidak ditemukan.');
        }

        $barang->delete();

        return back()->with('success', 'Barang berhasil dihapus!');
    }

    // =====================
    // Cari
    // =====================
   public function cari(Request $request)
    {
        $q = $request->q;
        $kategori = $request->kategori;

        $query = Barang::query();

        if ($q) {
            $query->where(function ($x) use ($q) {
                $x->where('id_barang', 'like', "%$q%")
                ->orWhere('nama_barang', 'like', "%$q%");
            });
        }

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $hasil_pencarian = $query->get();

        // 🔥 KATEGORI FIX (SAMA DENGAN INPUT BARANG)
        $kategori_list = [
            'Makanan',
            'Minuman',
            'ATK',
            'Elektronik',
            'Sembako',
            'Kebutuhan Rumah',
            'Kosmetik',
        ];

        return view('barang.cari', compact(
            'hasil_pencarian',
            'kategori_list'
        ));
    }

    public function manage()
    {
        $data_barang = Barang::all();
        return view('barang.manage', compact('data_barang'));
    }

    public function hapus()
    {
        $data_barang = Barang::all();
        return view('barang.hapus', compact('data_barang'));
    }
}
