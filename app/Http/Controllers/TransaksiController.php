<?php
require_once "config/database.php";
require_once "model/Transaksi.php";

class TransaksiController {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->model = new Transaksi($db);
    }

    public function tampilkanDaftar() {
        return $this->model->readAll();
    }

    public function simpanTransaksi($data) {
        $this->model->nama_barang = $data['nama_barang'];
        $this->model->harga = $data['harga'];
        $this->model->jumlah = $data['jumlah'];
        return $this->model->create();
    }
}
?>
