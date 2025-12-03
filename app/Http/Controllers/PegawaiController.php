<?php

namespace App\Http\Controllers;

use App\Models\PegawaiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function menu()
    {
        return view('pegawai.menu');
    }

    public function index()
    {
        $pegawai = PegawaiModel::orderBy('namaPegawai', 'asc')->get();
        return view('pegawai.manage', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPegawai'     => 'required|unique:pegawai,idPegawai',
            'namaPegawai'   => 'required|max:255',
            'jenisKelamin'  => 'required|in:Laki-Laki,Perempuan',
            'umur'          => 'required|integer|min:18',
            'email'         => 'required|email|unique:pegawai,email',
            'password'      => 'required|min:6',
        ]);

        PegawaiModel::create([
            'idPegawai'     => $request->idPegawai,
            'namaPegawai'   => $request->namaPegawai,
            'jenisKelamin'  => $request->jenisKelamin,
            'umur'          => $request->umur,
            'email'         => $request->email,
            'password'      => Hash::make($request->password), // wajib HASH
        ]);

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditambahkan!');
    }

    public function edit(PegawaiModel $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, PegawaiModel $pegawai)
    {
        $request->validate([
            'namaPegawai'   => 'required|max:255',
            'jenisKelamin'  => 'required|in:Laki-Laki,Perempuan',
            'umur'          => 'required|integer|min:18',
            'email'         => 'required|email|unique:pegawai,email,'.$pegawai->idPegawai.',idPegawai',
        ]);

        // Kalau password kosong, jangan ubah
        $data = [
            'namaPegawai' => $request->namaPegawai,
            'jenisKelamin' => $request->jenisKelamin,
            'umur' => $request->umur,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pegawai->update($data);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil diperbarui!');
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $pegawai = PegawaiModel::where('namaPegawai', 'like', "%{$keyword}%")
            ->orWhere('idPegawai', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            ->get();

        return view('pegawai.search', compact('pegawai', 'keyword'));
    }
}
