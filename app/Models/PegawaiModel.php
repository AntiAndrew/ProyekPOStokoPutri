<?php
class PegawaiModel {
    private $conn;

    public function __construct() {
        // Koneksi ke database
        $this->conn = new mysqli('localhost', 'root', '', 'toko');
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
    // Menampilkan semua data pegawai
    public function getAll() {
        return $this->conn->query("SELECT * FROM pegawai");
    }
    public function insert($idPegawai, $namaPegawai, $jenisKelamin, $umurPegawai) {
        $query = "INSERT INTO pegawai (idPegawai, namaPegawai, jenisKelamin, umurPegawai)
                  VALUES ('$idPegawai', '$namaPegawai', '$jenisKelamin', '$umurPegawai')";
        return $this->conn->query($query);
    }
    // Mencari data pegawai berdasarkan ID
    public function find($idPegawai) {
        $query = "SELECT * FROM pegawai WHERE idPegawai = $idPegawai";
        return $this->conn->query($query)->fetch_assoc();
    }
    // Mengupdate data pegawai
    public function update($idPegawai, $namaPegawai, $jenisKelamin, $umurPegawai) {
        $query = "UPDATE pegawai 
                  SET namaPegawai='$namaPegawai', jenisKelamin='$jenisKelamin', umurPegawai='$umurPegawai' 
                  WHERE idPegawai=$idPegawai";
        return $this->conn->query($query);
    }
     // Menghapus data pegawai berdasarkan ID
    public function delete($idPegawai) {
        $query = "DELETE FROM pegawai WHERE idPegawai=$idPegawai";
        return $this->conn->query($query);
    }
    // Mencari pegawai berdasarkan nama
    public function search($keyword) {
        $query = "SELECT * FROM pegawai WHERE namaPegawai LIKE '%$keyword%'";
        return $this->conn->query($query);
    }

}