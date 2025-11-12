<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\Barang;
// use App\Models\Pelanggan; // jika ada model Pelanggan
// use App\Models\User;      // jika ada model User
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
     * Alasan perbaikan: Memastikan view transaksi.index menampilkan daftar,
     * bukan detail transaksi.
     */
    public function index()
    {
        $transaksi = Transaksi::withCount('items')
                            ->with('user') 
                            ->orderBy('tanggal','desc')
                            ->paginate(15);
        
        // Pengecekan opsional: Jika tidak ada transaksi, arahkan ke buat transaksi baru.
        // Jika Anda ingin menampilkan daftar kosong, hapus blok if ini.
        if ($transaksi->isEmpty() && request()->page == 1) {
            return redirect()->route('transaksi.create')
                             ->with('info', 'Anda belum memiliki transaksi. Silakan buat transaksi baru.');
        }

        // PERHATIAN: Pastikan file blade 'transaksi.index' berisi daftar/tabel transaksi.
        return view('transaksi.index', compact('transaksi'));
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
     * Alasan Perbaikan: Bagian ini sudah benar dan sengaja me-redirect ke 'transaksi.show'
     * setelah berhasil disimpan, sesuai dengan gambar kedua Anda (Detail Transaksi TR-20251111-LASS).
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

            // Redirect ke halaman detail transaksi setelah simpan (sesuai gambar kedua)
            return redirect()->route('transaksi.show', $transaksi->id)
                             ->with('success', 'Transaksi berhasil disimpan! Anda sekarang melihat detail barang yang dibeli.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: '.$e->getMessage())->withInput();
        }
    }

    // Detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with(['items', 'user'])->find($id); // Items sudah ada relasi ke barang di model.
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
        // PERHATIAN: Pastikan file blade 'transaksi.show' berisi tampilan detail.
        return view('transaksi.show', compact('transaksi'));
    }

    // Manage transaksi (edit/delete) - Menampilkan daftar khusus untuk mode edit/hapus
    public function manage(Request $request)
    {
        $mode = $request->query('mode', 'edit'); // edit atau delete
        $data = Transaksi::withCount('items')->orderBy('tanggal','desc')->get();
        // PERHATIAN: Pastikan file blade 'transaksi.manage' berisi daftar/tabel transaksi.
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
            // Perhatikan: Saat update, Anda juga harus mengembalikan stok lama terlebih dahulu
            // dan mengurangi stok baru (jika Anda menerapkan manajemen stok).
            // Bagian stok update tidak diubah untuk menjaga fungsionalitas stok yang Anda miliki.

            foreach ($request->items as $it) {
                $subtotal += $it['jumlah'] * $it['harga_satuan'];
            }
            $diskon = $request->diskon ?? 0;
            $total = $subtotal - $diskon;

            $transaksi->update([
                'tanggal' => $request->tanggal,
                'pelanggan' => $request->pelanggan,
                'subtotal' => $subtotal,
                'diskon' => $diskon,
                'total' => $total,
            ]);

            // Hapus item lama
            $transaksi->items()->delete();

            // Insert item baru
            foreach ($request->items as $it) {
                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'id_barang' => $it['id_barang'],
                    'nama_barang' => $it['nama_barang'],
                    'jumlah' => $it['jumlah'],
                    'harga_satuan' => $it['harga_satuan'],
                    'subtotal' => $it['jumlah'] * $it['harga_satuan'],
                ]);
            }

            DB::commit();
            
            // Redirect ke halaman detail transaksi setelah update.
            return redirect()->route('transaksi.show', $transaksi->id)->with('success','Transaksi berhasil diperbarui.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error','Gagal memperbarui transaksi: '.$e->getMessage());
        }
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $t = Transaksi::find($id);
        if (!$t) return redirect()->back()->with('error','Transaksi tidak ditemukan.');
        try {
            // Anda mungkin perlu mengembalikan stok barang yang dihapus di sini
            $t->delete();
            return redirect()->route('transaksi.manage', ['mode' => 'delete'])->with('success','Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Gagal menghapus: '.$e->getMessage());
        }
    }

    // Pencarian transaksi
    public function cari(Request $request)
    {
        $q = $request->query('q');
        $hasil = collect([]);
        if ($q) {
            $hasil = Transaksi::where('no_transaksi','like',"%{$q}%")
                ->orWhere('pelanggan','like',"%{$q}%")
                ->with('items') // cukup with('items') karena relasi ke barang sudah di handle di model
                ->get();
        }
        return view('transaksi.cari', ['hasil' => $hasil, 'q' => $q]);
    }
}