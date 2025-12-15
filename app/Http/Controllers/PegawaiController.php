<?php

namespace App\Http\Controllers;

use App\Models\PegawaiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Add DB if needed for complex queries

class PegawaiController extends Controller
{
    /**
     * Tampilkan menu utama pegawai.
     */
    public function menu() 
    {
        return view('pegawai.menu'); 
    }

    public function index()
    {
        $pegawai = PegawaiModel::orderBy('namaPegawai', 'asc')->get();
        // Assuming you meant to use 'pegawai.index' for the list view
        return view('pegawai.index', compact('pegawai')); 
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
            'jenisKelamin'  => 'required|in:Laki-laki,Perempuan',
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
            'password'      => Hash::make($request->password), 
        ]);

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditambahkan!');
    }

    public function show($id) 
    {
        // Redirect to index — we don't use the show view in current flow
        return redirect()->route('pegawai.index');
    }

    public function edit($id)
    {
        $pegawai = PegawaiModel::where('idPegawai', $id)->firstOrFail();
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = PegawaiModel::where('idPegawai', $id)->firstOrFail();
        
        $request->validate([
            'namaPegawai'   => 'required|max:255',
            'jenisKelamin'  => 'required|in:Laki-laki,Perempuan',
            'umur'          => 'required|integer|min:18',
            // Unique check ignores the current record's email
            'email'         => 'required|email|unique:pegawai,email,'.$pegawai->idPegawai.',idPegawai', 
        ]);

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
    
    public function destroy($id)
    {
        $pegawai = PegawaiModel::where('idPegawai', $id)->firstOrFail();
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil dihapus.');
    }

    public function search(Request $request)
{
    $keyword = $request->keyword;       // keyword: id/nama/email
    $jenisKelamin = $request->jenis_kelamin; // optional filter: gender

    $query = PegawaiModel::query();

    // Jika ada keyword
    if ($keyword) {
        $query->where(function($q) use ($keyword) {
            $q->where('idPegawai', 'LIKE', "%{$keyword}%")
              ->orWhere('namaPegawai', 'LIKE', "%{$keyword}%")
              ->orWhere('email', 'LIKE', "%{$keyword}%");
        });
    }

    // Jika filter jenis kelamin dipilih
    if ($jenisKelamin) {
        $query->where('jenisKelamin', $jenisKelamin);
    }

    // Ambil hasil pencarian dengan pagination
    $hasil_pencarian = $query->paginate(15)->appends($request->except('page'));

    // Ambil list jenis kelamin unik untuk dropdown
    $jenis_kelamin_list = PegawaiModel::select('jenisKelamin')->distinct()->pluck('jenisKelamin');

    return view('pegawai.search', [
        'hasil_pencarian'  => $hasil_pencarian,
        'keyword'          => $keyword,
        'jenis_kelamin'    => $jenis_kelamin_list
    ]);
}

}