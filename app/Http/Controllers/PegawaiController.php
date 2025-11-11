<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * READ: Menampilkan daftar pegawai
     * Route: GET /pegawai
     */
    public function index()
    {
        $pegawai = PegawaiModel::orderBy('namaPegawai', 'asc')->get();
        return view('pegawai.pegawaiIndex', compact('pegawai'));
    }

    /**
     * CREATE: Form tambah pegawai
     * Route: GET /pegawai/create
     */
    public function create()
    {
        return view('pegawai.inputPegawai');
    }

    /**
     * STORE: Simpan pegawai baru
     * Route: POST /pegawai
     */
    public function store(Request $request)
    {
        $request->validate([
            'idPegawai'     => 'required|unique:pegawai,idPegawai',
            'namaPegawai'   => 'required|max:255',
            'jenisKelamin'  => 'required|in:Laki-Laki,Perempuan',
            'umurPegawai'   => 'required|integer|min:18',
        ]);

        PegawaiModel::create($request->all());

        return redirect()->route('pegawai.index')
                         ->with('success', '✅ Pegawai berhasil ditambahkan!');
    }

    /**
     * EDIT: Form edit pegawai
     * Route: GET /pegawai/{id}/edit
     */
    public function edit(PegawaiModel $pegawai)
    {
        return view('pegawai.editPegawai', compact('pegawai'));
    }

    /**
     * UPDATE: Update data pegawai
     * Route: PUT /pegawai/{id}
     */
    public function update(Request $request, PegawaiModel $pegawai)
    {
        $request->validate([
            'namaPegawai'   => 'required|max:255',
            'jenisKelamin'  => 'required|in:Laki-Laki,Perempuan',
            'umurPegawai'   => 'required|integer|min:18',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')
                         ->with('success', '♻️ Data pegawai berhasil diperbarui!');
    }

    
    /**
     * SEARCH: Cari pegawai
     * Route: GET /pegawai/search
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $pegawai = PegawaiModel::where('namaPegawai','like',"%{$keyword}%")
                           ->orWhere('idPegawai','like',"%{$keyword}%")
                           ->get();

        return view('pegawai.cariPegawai', compact('pegawai', 'keyword'));
    }
}
