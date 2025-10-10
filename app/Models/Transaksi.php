<?php
class Transaksi {
    private $conn;
    private $table = "transaksi";

    public $id;
    public $nama_barang;
    public $harga;
    public $jumlah;
    public $total;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (nama_barang, harga, jumlah, total) VALUES (:nama_barang, :harga, :jumlah, :total)";
        $stmt = $this->conn->prepare($query);
        $this->total = $this->harga * $this->jumlah;

        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":jumlah", $this->jumlah);
        $stmt->bindParam(":total", $this->total);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
