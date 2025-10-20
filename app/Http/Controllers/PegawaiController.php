<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;  // assuming you have Pegawai model
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        // example: retrieve data and return view
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('pegawai.create');
    }
}
    