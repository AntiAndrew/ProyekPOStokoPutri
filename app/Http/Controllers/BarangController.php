<?php
require_once 'models/BarangModel.php';

class BarangController {
    private $model;

    public function __construct() {
        $this->model = new BarangModel();
    }

    // Input Barang
    public function inputBarang() {
        include 'views/barang/input_barang.php';
    }

    public function simpanBarang() {
        $this->model->insert($_POST['nama'], $_POST['harga'], $_POST['stok']);
        header('Location: index.php?action=lihatDaftarBarang');
    }

    // Lihat Daftar Barang
    public function lihatDaftarBarang() {
        $data = $this->model->getAll();
        include 'views/barang/lihat_daftar_barang.php';
    }

    // Edit Barang
    public function editBarang($id) {
        $barang = $this->model->find($id);
        include 'views/barang/edit_barang.php';
    }

    public function updateBarang($id) {
        $this->model->update($id, $_POST['nama'], $_POST['harga'], $_POST['stok']);
        header('Location: index.php?action=lihatDaftarBarang');
    }

    // Hapus Barang
    public function hapusBarang($id) {
        $this->model->delete($id);
        header('Location: index.php?action=lihatDaftarBarang');
    }

    // Cari Barang
    public function cariBarang() {
        $keyword = $_GET['keyword'] ?? '';
        $data = $this->model->search($keyword);
        include 'views/barang/cari_barang.php';
    }
}
