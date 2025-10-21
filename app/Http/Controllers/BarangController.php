<?php
require_once 'config/database.php';
require_once 'models/BarangModel.php';

class BarangController {
    private $model;

    public function __construct($conn) {
        $this->model = new BarangModel($conn);
    }

    public function inputBarang() {
        include 'input_barang.php';
    }

    public function simpanBarang() {
        global $conn;
        $this->model->insert($_POST['nama'], $_POST['harga'], $_POST['stok']);
        header('Location: index.php');
    }

    public function lihatBarang() {
        $data = $this->model->getAll();
        include 'lihat_barang.php';
    }

    public function editBarang($id) {
        $barang = $this->model->find($id);
        include 'edit_barang.php';
    }

    public function updateBarang($id) {
        $this->model->update($id, $_POST['nama'], $_POST['harga'], $_POST['stok']);
        header('Location: index.php');
    }

    public function hapusBarang($id) {
        $this->model->delete($id);
        header('Location: index.php');
    }

    public function cariBarang() {
        $keyword = $_GET['keyword'] ?? '';
        $data = $this->model->search($keyword);
        include 'cari_barang.php';
    }
}
?>
