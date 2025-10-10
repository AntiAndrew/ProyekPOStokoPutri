<?php
class BarangModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'toko');
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM barang");
    }

    public function insert($nama, $harga, $stok) {
        return $this->conn->query("INSERT INTO barang (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')");
    }

    public function find($id) {
        return $this->conn->query("SELECT * FROM barang WHERE id=$id")->fetch_assoc();
    }

    public function update($id, $nama, $harga, $stok) {
        return $this->conn->query("UPDATE barang SET nama='$nama', harga='$harga', stok='$stok' WHERE id=$id");
    }

    public function delete($id) {
        return $this->conn->query("DELETE FROM barang WHERE id=$id");
    }

    public function search($keyword) {
        return $this->conn->query("SELECT * FROM barang WHERE nama LIKE '%$keyword%'");
    }
}
