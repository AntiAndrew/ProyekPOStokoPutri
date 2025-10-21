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
<<<<<<< HEAD
        $query = "SELECT * FROM " . $this->table;
=======
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
>>>>>>> 7c386ac (commit pertama project toko putri)
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

<<<<<<< HEAD
    public function create() {
        $query = "INSERT INTO " . $this->table . " (nama_barang, harga, jumlah, total) VALUES (:nama_barang, :harga, :jumlah, :total)";
=======
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (nama_barang, harga, jumlah, total)
                  VALUES (:nama_barang, :harga, :jumlah, :total)";
>>>>>>> 7c386ac (commit pertama project toko putri)
        $stmt = $this->conn->prepare($query);
        $this->total = $this->harga * $this->jumlah;

        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":jumlah", $this->jumlah);
        $stmt->bindParam(":total", $this->total);
<<<<<<< HEAD

        if ($stmt->execute()) {
            return true;
        }
        return false;
=======
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET nama_barang = :nama_barang, harga = :harga, jumlah = :jumlah, total = :total 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->total = $this->harga * $this->jumlah;

        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":jumlah", $this->jumlah);
        $stmt->bindParam(":total", $this->total);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
>>>>>>> 7c386ac (commit pertama project toko putri)
    }
}
?>
