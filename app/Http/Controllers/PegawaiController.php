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