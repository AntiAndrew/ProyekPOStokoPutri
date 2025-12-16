<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang; // Dibiarkan jika ingin mengakses data barang
use App\Models\LaporanPenjualan; // Dihapus dari logika fungsi
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;
use App\Models\User;

class TransaksiController extends Controller
{
    // Menu utama transaksi
    public function menu()
    {
        return view('transaksi.menu_kelola_transaksi');
    }

    // Daftar transaksi (Lihat Daftar)
    public function index(Request $request)
    {
        $query = Transaksi::with('pegawai')->orderBy('tanggal','desc');
        $q = $request->query('q');

        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('id_transaksi', 'like', "%{$q}%")
                      ->orWhere('nama_barang', 'like', "%{$q}%");
            });
        }

        $transaksi = $query->paginate(15)->appends(['q' => $q]);

        if ($transaksi->isEmpty() && request()->page == 1 && !$q) {
            return redirect()->route('transaksi.create')
                             ->with('info', 'Anda belum memiliki transaksi. Silakan buat transaksi baru.');
        }

        return view('transaksi.index', compact('transaksi', 'q'));
    }

    // Halaman tambah transaksi
    public function create()
    {
        $barang = Barang::all();
        $id_transaksi_baru = 'TR-'.Carbon::now()->format('Ymd').'-'.Str::upper(Str::random(4));
        $pegawai = User::all();

        return view('transaksi.create', compact('barang','id_transaksi_baru', 'pegawai'));
    }

    // Simpan transaksi baru (Input)
    public function store(Request $request)
    {
        // 1. Validasi Input
       $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required|string|unique:transaksi,id_transaksi',
            'tanggal' => 'required|date',
            'id_barang' => 'required|string',
            'nama_barang' => 'required|string',
            'harga_barang' => 'required|numeric|min:0',
            'jumlah_barang' => 'required|integer|min:1',
            'id_pegawai' => 'required|integer|exists:users,id',
            // Pastikan total_harga ada, meskipun sudah dihitung di frontend
            'total_harga' => 'required|numeric|min:0', 
        ]);

        if ($validator->fails()) {
            // Jika validasi GAGAL, akan kembali ke halaman input dengan pesan error.
            // Inilah alasan utama Anda tetap di halaman input.
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $harga_barang = $request->harga_barang;
        $jumlah_barang = $request->jumlah_barang;
        $total_harga = $harga_barang * $jumlah_barang;

        // **CATATAN:** Pengecekan stok dihapus

        DB::beginTransaction();
        try {
            // Catat Transaksi
            Transaksi::create([
                'id_transaksi' => $request->id_transaksi,
                'tanggal' => $request->tanggal,
                'id_barang' => $request->id_barang,
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $harga_barang,
                'jumlah_barang' => $jumlah_barang,
                'total_harga' => $total_harga,
                'id_pegawai' => $request->id_pegawai,
            ]);

            // **CATATAN:** Logika LaporanPenjualan dihapus
            // **CATATAN:** Logika pengurangan stok dihapus

            DB::commit();
            
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: '.$e->getMessage())->withInput();
        }
    }

    // Detail transaksi (Lihat)
    public function show($id_transaksi)
    {
        $transaksi = Transaksi::with('pegawai')->where('id_transaksi', $id_transaksi)->first(); 
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
        return view('transaksi.show', compact('transaksi'));
    }

    // Manage transaksi
    public function manage(Request $request)
    {
        $mode = $request->query('mode', 'edit'); 
        $data = Transaksi::orderBy('tanggal','desc')->get(); 
        return view('transaksi.manage', compact('data','mode'));
    }

    // Edit transaksi (Form)
    public function edit($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if (!$transaksi) return redirect()->route('transaksi.manage')->with('error','Transaksi tidak ditemukan.');
        $barang = Barang::all();
        $pegawai = User::all();
        return view('transaksi.edit', compact('transaksi','barang', 'pegawai'));
    }

    // Update transaksi (Edit)
    public function update(Request $request, $id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if (!$transaksi) return redirect()->route('transaksi.manage')->with('error','Transaksi tidak ditemukan.');

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'id_barang' => 'required|string',
            'nama_barang' => 'required|string',
            'harga_barang' => 'required|numeric|min:0',
            'jumlah_barang' => 'required|integer|min:1',
            'id_pegawai' => 'required|integer|exists:users,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $harga_barang_baru = $request->harga_barang;
        $jumlah_barang_baru = $request->jumlah_barang;
        $total_harga_baru = $harga_barang_baru * $jumlah_barang_baru;
        $id_barang_baru = $request->id_barang;

        DB::beginTransaction();
        try {
            // **CATATAN:** Logika pengembalian/pengurangan stok dihapus

            // Update transaksi
            $transaksi->update([
                'tanggal' => $request->tanggal,
                'id_barang' => $request->id_barang,
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $harga_barang_baru,
                'jumlah_barang' => $jumlah_barang_baru,
                'total_harga' => $total_harga_baru,
                'id_pegawai' => $request->id_pegawai,
            ]);

            // **CATATAN:** Logika pembaruan laporan penjualan dihapus
            
            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal memperbarui transaksi: '.$e->getMessage());
        }
    }

    // Hapus transaksi (Hapus)
    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        DB::beginTransaction();
        try {
            // **CATATAN:** Logika pengembalian stok dihapus
            // **CATATAN:** Logika penghapusan laporan penjualan dihapus

            $transaksi->delete();

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus transaksi: '.$e->getMessage());
        }
    }
}