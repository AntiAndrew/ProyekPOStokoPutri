<<<<<<< HEAD
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
    
=======
<?php 
require_once 'models/PegawaiModel.php';

class PegawaiController {
    private $model;
    public function __construct(){
        $this->model = new PegawaiModel();
    }
    // Input Pegawai
    public function inputPegawai() {
        include 'views/pegawai/inputPegawai.php';
    }
}
>>>>>>> 7c386ac (commit pertama project toko putri)
