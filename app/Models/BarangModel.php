<?php
class BarangModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM barang");
    }

    public function insert($nama, $harga, $stok) {
        $sql = "INSERT INTO barang (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')";
        return $this->conn->query($sql);
    }

    public function find($id) {
        return $this->conn->query("SELECT * FROM barang WHERE id=$id")->fetch_assoc();
    }

    public function update($id, $nama, $harga, $stok) {
        $sql = "UPDATE barang SET nama='$nama', harga='$harga', stok='$stok' WHERE id=$id";
        return $this->conn->query($sql);
    }

    public function delete($id) {
        return $this->conn->query("DELETE FROM barang WHERE id=$id");
    }

    public function search($keyword) {
        return $this->conn->query("SELECT * FROM barang WHERE nama LIKE '%$keyword%'");
    }
}
?>
