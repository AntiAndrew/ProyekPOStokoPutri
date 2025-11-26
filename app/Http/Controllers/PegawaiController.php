<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PegawaiModel;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    // Menu utama pegawai
    public function menu()
    {
        return view('pegawai.menu');
    }

    /**
     * Tampilkan daftar pegawai (READ)
     * Route: GET /pegawai
     */
    public function index()
    {
        $pegawai = PegawaiModel::orderBy('nama_pegawai', 'asc')->paginate(15);

        if ($pegawai->isEmpty() && request()->page == 1) {
            return redirect()->route('pegawai.create')
                             ->with('info', 'Belum ada pegawai, silakan tambahkan data baru.');
        }

        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Form tambah pegawai
     * Route: GET /pegawai/create
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Simpan pegawai baru (STORE)
     * Route: POST /pegawai
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pegawai'    => 'required|unique:pegawai,id_pegawai',
            'nama_pegawai'  => 'required|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'umur'          => 'required|integer|min:18',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PegawaiModel::create($request->all());

        return redirect()->route('pegawai.index')
                         ->with('success', 'Pegawai berhasil ditambahkan!');
    }

    /**
     * Detail pegawai (SHOW)
     * Route: GET /pegawai/{id}
     */
    public function show($id)
    {
        $pegawai = PegawaiModel::where('id_pegawai', $id)->first();

        if (!$pegawai) {
            return redirect()->route('pegawai.index')
                             ->with('error', 'Pegawai tidak ditemukan.');
        }

        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Halaman manage pegawai (edit/hapus list)
     * Route: GET /pegawai/manage?mode=edit/delete
     */
    public function manage(Request $request)
    {
        $mode = $request->query('mode', 'edit');
        $data = PegawaiModel::orderBy('nama_pegawai', 'asc')->get();

        return view('pegawai.manage', compact('data', 'mode'));
    }

    /**
     * Form edit pegawai (EDIT)
     * Route: GET /pegawai/{id}/edit
     */
    public function edit($id)
    {
        $pegawai = PegawaiModel::where('id_pegawai', $id)->first();

        if (!$pegawai) {
            return redirect()->route('pegawai.manage')->with('error', 'Pegawai tidak ditemukan.');
        }

        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update data pegawai (UPDATE)
     * Route: PUT /pegawai/{id}
     */
    public function update(Request $request, $id)
    {
        $pegawai = PegawaiModel::where('id_pegawai', $id)->first();
        if (!$pegawai) {
            return redirect()->route('pegawai.manage')->with('error', 'Pegawai tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'nama_pegawai'  => 'required|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'umur'          => 'required|integer|min:18',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pegawai->update($request->all());

        return redirect()->route('pegawai.show', $pegawai->id_pegawai)
                         ->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Hapus pegawai (DELETE)
     * Route: DELETE /pegawai/{id}
     */
    public function destroy($id)
    {
        $pegawai = PegawaiModel::where('id_pegawai', $id)->first();
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan.');
        }

        try {
            $pegawai->delete();
            return redirect()->route('pegawai.manage', ['mode' => 'delete'])
                             ->with('success', 'Pegawai berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    /**
     * Pencarian pegawai
     * Route: GET /pegawai/search
     */
    public function search(Request $request)
    {
        $keyword = $request->query('keyword');

        $pegawai = PegawaiModel::where('nama_pegawai', 'like', "%{$keyword}%")
                                ->orWhere('id_pegawai', 'like', "%{$keyword}%")
                                ->get();

        return view('pegawai.search', compact('pegawai', 'keyword'));
    }
}
