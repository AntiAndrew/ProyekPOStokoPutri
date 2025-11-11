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
    // Menu utama kelola transaksi
    public function menu()
    {
        return view('transaksi.menu_kelola_transaksi');
    }

    // Lihat daftar transaksi
    public function index()
    {
        $transaksi = Transaksi::withCount('items')->orderBy('tanggal','desc')->paginate(15);
        return view('transaksi.index', compact('transaksi'));
    }

    // Halaman input transaksi (create)
    public function create()
    {
        // contoh ambil semua barang untuk auto-complete/select
        $barang = Barang::all();
        // Buat nomor transaksi sederhana: TR-YYYYMMDD-XXXX
        $no = 'TR-'.Carbon::now()->format('Ymd').'-'.Str::upper(Str::random(4));
        return view('transaksi.create', compact('barang','no'));
    }

    // Simpan transaksi baru
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
            $subtotal = 0;
            foreach ($request->items as $it) {
                $subtotal += ($it['jumlah'] * $it['harga_satuan']);
            }
            $diskon = $request->diskon ?? 0;
            $total = $subtotal - $diskon;

            $transaksi = Transaksi::create([
                'no_transaksi' => $request->no_transaksi,
                'tanggal' => $request->tanggal,
                'pelanggan' => $request->pelanggan,
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'diskon' => $diskon,
                'total' => $total,
                'status' => 'selesai',
            ]);

            // simpan item
            foreach ($request->items as $it) {
                TransaksiItem::create([
                    'transaksi_id' => $transaksi->id,
                    'id_barang' => $it['id_barang'],
                    'nama_barang' => $it['nama_barang'],
                    'jumlah' => $it['jumlah'],
                    'harga_satuan' => $it['harga_satuan'],
                    'subtotal' => $it['jumlah'] * $it['harga_satuan'],
                ]);

                // Opsional: update stok barang jika ingin (jika tabel Barang menyimpan jumlah)
                $barang = Barang::where('id_barang', $it['id_barang'])->first();
                if ($barang && is_numeric($barang->jumlah_barang)) {
                    $barang->jumlah_barang = max(0, $barang->jumlah_barang - $it['jumlah']);
                    $barang->save();
                }
            }

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi: '.$e->getMessage())->withInput();
        }
    }

    // Menampilkan detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('items')->find($id);
        if (!$transaksi) {
            return redirect()->route('transaksi.index')->with('error', 'Transaksi tidak ditemukan.');
        }
        return view('transaksi.show', compact('transaksi'));
    }

    // Manage (edit/delete list)
    public function manage(Request $request)
    {
        $mode = $request->query('mode', 'edit'); // edit atau delete
        $data = Transaksi::withCount('items')->orderBy('tanggal','desc')->get();
        return view('transaksi.manage', compact('data','mode'));
    }

    // Halaman edit transaksi (langsung edit header saja; item editing bisa diperluas)
    public function edit($id)
    {
        $transaksi = Transaksi::with('items')->find($id);
        if (!$transaksi) return redirect()->route('transaksi.manage')->with('error','Transaksi tidak ditemukan.');
        $barang = Barang::all();
        return view('transaksi.edit', compact('transaksi','barang'));
    }

    // Update transaksi (header + items — implementasi sederhana: hapus semua items lalu insert ulang)
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
            $subtotal = 0;
            foreach ($request->items as $it) {
                $subtotal += ($it['jumlah'] * $it['harga_satuan']);
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

            // hapus item lama
            $transaksi->items()->delete();

            // insert item baru
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
            return redirect()->route('transaksi.manage', ['mode' => 'edit'])->with('success','Transaksi diperbarui.');
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
            $t->delete();
            return redirect()->route('transaksi.manage', ['mode' => 'delete'])->with('success','Transaksi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','Gagal menghapus: '.$e->getMessage());
        }
    }

    // Halaman cari transaksi
    public function cari(Request $request)
    {
        $q = $request->query('q');
        $hasil = collect([]);
        if ($q) {
            $hasil = Transaksi::where('no_transaksi','like',"%{$q}%")
                ->orWhere('pelanggan','like',"%{$q}%")
                ->with('items')
                ->get();
        }
        return view('transaksi.cari', ['hasil' => $hasil, 'q' => $q]);
    }
}
