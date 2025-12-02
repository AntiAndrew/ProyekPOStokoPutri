<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class TransaksiController extends Controller
{
    // Menu utama transaksi
    public function menu()
    {
        return view('transaksi.menu_kelola_transaksi');
    }

    /**
     * Tampilkan daftar transaksi.
     */
    public function index(Request $request)
    {
        // Eager load relasi user untuk ditampilkan di list
        $query = Transaksi::withCount('items')->with('user')->orderBy('tanggal','desc');
        $q = $request->query('q');

        // Logic Pencarian
        if ($q) {
            $query->where(function ($query) use ($q) {
                $query->where('no_transaksi', 'like', "%{$q}%")
                      ->orWhere('pelanggan', 'like', "%{$q}%");
            });
        }

        $transaksi = $query->paginate(15)->appends(['q' => $q]);
        
        // --- Perbaikan Logic Redirect/Handling Data Kosong ---
        
        // Kasus 1: Tidak ada data transaksi sama sekali (dan tidak ada query pencarian)
        if ($transaksi->isEmpty() && request()->page == 1 && !$q) {
            return redirect()->route('transaksi.create')
                             ->with('info', 'Anda belum memiliki transaksi. Silakan buat transaksi baru.');
        }

        // Kasus 2: Hasil pencarian di halaman ini kosong (tidak ada data, tapi ada query pencarian)
        // Di sini kita tetap me-return view index, dan view yang akan menampilkan pesan "Data tidak ditemukan."

        return view('transaksi.index', compact('transaksi', 'q'));
    }

    // Halaman tambah transaksi
    public function create()
    {
        $barang = Barang::all();
        // Format No. Transaksi: TR-YYYYMMDD-RANDOM
        $no = 'TR-'.Carbon::now()->format('Ymd').'-'.Str::upper(Str::random(4));
        return view('transaksi.create', compact('barang','no'));
    }

    /**
     * Simpan transaksi baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_transaksi' => 'required|string|unique:transaksi,no_transaksi',
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.id_barang' => 'required|string',
            'items.*.nama_barang' => 'required|string',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga_satuan' => 'required|numeric|min:0',
            'diskon' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // Hitung subtotal dan total
            $subtotal = 0;
            foreach ($request->items as $it) {
                $subtotal += $it['jumlah'] * $it['harga_satuan'];
            }
            $diskon = $request->diskon ?? 0;
            $total = $subtotal - $diskon;

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'no_transaksi' => $request->no_transaksi,
                'tanggal' => $request->tanggal,
                'pelanggan' => $request->pelanggan, // kolom string
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'diskon' => $diskon,
                'total' => $total,
                'status' => 'selesai',
            ]);

            // Simpan item transaksi dan update stok
            foreach ($request->items as $it) {
                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'id_barang' => $it['id_barang'],
                    'nama_barang' => $it['nama_barang'],
                    'jumlah' => $it['jumlah'],
                    'harga_satuan' => $it['harga_satuan'],
                    'subtotal' => $it['jumlah'] * $it['harga_satuan'],
                ]);

                // Update stok barang jika ada kolom 'jumlah_barang'
                $barang = Barang::where('id_barang', $it['id_barang'])->first();
                if ($barang && property_exists($barang, 'jumlah_barang') && is_numeric($barang->jumlah_barang)) {
                    // Pastikan stok tidak negatif
                    $barang->jumlah_barang = max(0, $barang->jumlah_barang - $it['jumlah']);
                    $barang->save();
                }
            }

            DB::commit();

            // Redirect ke halaman detail transaksi setelah simpan
            return redirect()->route('transaksi.show', $transaksi->id)
                             ->with('success', 'Transaksi berhasil disimpan! Anda sekarang melihat detail barang yang dibeli.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: '.$e->getMessage())->withInput();
        }
    }

    /**
     * Detail transaksi.
     */
    public function show($id)
    {
        // Eager loading relasi yang dibutuhkan: items, barang pada items, dan user.
        $transaksi = Transaksi::with(['items.barang', 'user'])->find($id); 
        
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
        
        // Memastikan relasi 'pelanggan' dimuat, jika model Pelanggan ada
        // Jika kolom 'pelanggan' di tabel Transaksi adalah string (seperti di method store), 
        // maka tidak perlu load relasi.
        
        return view('transaksi.show', compact('transaksi'));
    }

    // Manage transaksi (edit/delete) - Menampilkan daftar khusus untuk mode edit/hapus
    public function manage(Request $request)
    {
        $mode = $request->query('mode', 'edit'); // edit atau delete
        $data = Transaksi::withCount('items')->orderBy('tanggal','desc')->get();
        return view('transaksi.manage', compact('data','mode'));
    }

    // Edit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::with('items')->find($id);
        if (!$transaksi) return redirect()->route('transaksi.manage')->with('error','Transaksi tidak ditemukan.');
        $barang = Barang::all();
        return view('transaksi.edit', compact('transaksi','barang'));
    }

    // Update transaksi
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) return redirect()->route('transaksi.manage')->with('error','Transaksi tidak ditemukan.');

        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            // Hitung subtotal dan total
            $subtotal = 0;
            foreach ($request->items as $it) {
                $subtotal += $it['jumlah'] * $it['harga_satuan'];
            }
            $diskon = $request->diskon ?? 0;
            $total = $subtotal - $diskon;

            // Logika Update Stok (Sangat Penting):
            // 1. Kembalikan stok lama
            foreach ($transaksi->items as $itemLama) {
                $barang = Barang::where('id_barang', $itemLama->id_barang)->first();
                if ($barang && property_exists($barang, 'jumlah_barang') && is_numeric($barang->jumlah_barang)) {
                    $barang->jumlah_barang += $itemLama->jumlah;
                    $barang->save();
                }
            }

            $transaksi->update([
                'tanggal' => $request->tanggal,
                'pelanggan' => $request->pelanggan,
                'subtotal' => $subtotal,
                'diskon' => $diskon,
                'total' => $total,
            ]);

            // Hapus item lama (Setelah stok dikembalikan)
            $transaksi->items()->delete();

            // Insert item baru dan kurangi stok baru
            foreach ($request->items as $it) {
                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'id_barang' => $it['id_barang'],
                    'nama_barang' => $it['nama_barang'],
                    'jumlah' => $it['jumlah'],
                    'harga_satuan' => $it['harga_satuan'],
                    'subtotal' => $it['jumlah'] * $it['harga_satuan'],
                ]);
                 // Kurangi stok baru
                $barang = Barang::where('id_barang', $it['id_barang'])->first();
                if ($barang && property_exists($barang, 'jumlah_barang') && is_numeric($barang->jumlah_barang)) {
                    $barang->jumlah_barang = max(0, $barang->jumlah_barang - $it['jumlah']);
                    $barang->save();
                }
            }

            DB::commit();
            
            // Redirect ke halaman detail transaksi setelah update.
            return redirect()->route('transaksi.show', $transaksi->id)->with('success','Transaksi berhasil diperbarui.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal memperbarui transaksi: '.$e->getMessage());
        }
    }

    /**
     * Hapus transaksi (dengan pengembalian stok yang aman).
     */
    public function destroy($id)
    {
        // 1. Cari transaksi beserta item-itemnya
        $transaksi = Transaksi::with('items')->find($id);

        // Pengecekan
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // 2. Lakukan pengembalian stok untuk setiap item transaksi
            foreach ($transaksi->items as $item) {
                // Cari barang berdasarkan ID
                $barang = Barang::where('id_barang', $item->id_barang)->first();

                // Pastikan barang ditemukan dan memiliki kolom stok yang bisa diupdate
                if ($barang && property_exists($barang, 'jumlah_barang') && is_numeric($barang->jumlah_barang)) {
                    // Kembalikan stok
                    $barang->jumlah_barang += $item->jumlah;
                    $barang->save();
                } 
            }
            
            // 4. Hapus transaksi utama (dan itemnya jika menggunakan cascade)
            $transaksi->delete();

            // Commit transaksi
            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus dan stok barang telah dikembalikan.');
            
        } catch (\Exception $e) {
            // Rollback jika ada kegagalan
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }
}