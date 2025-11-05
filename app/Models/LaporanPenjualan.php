<?php

class LaporanPenjualan
{
    private $conn;
    private $table = "penjualan";

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "db_salon");

        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }

    public function getData($filterData = [])
    {
        $query = "SELECT * FROM $this->table";
        $filterText = "";

        if (!empty($filterData['rentang'])) {
            $rentang = $filterData['rentang'];

            switch ($rentang) {
                case "hari_ini":
                    $query .= " WHERE DATE(tanggal) = CURDATE()";
                    $filterText = "Hari Ini";
                    break;

                case "7_hari":
                    $query .= " WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                    $filterText = "7 Hari Terakhir";
                    break;

                case "bulan":
                    $bulan = $filterData['bulan'];
                    $tahun = $filterData['tahun'];
                    $query .= " WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
                    $filterText = "Periode: $bulan-$tahun";
                    break;

                case "tanggal":
                    $tgl = $filterData['tanggal'];
                    $query .= " WHERE tanggal = '$tgl'";
                    $filterText = "Tanggal: $tgl";
                    break;
            }
        }

        $query .= " ORDER BY tanggal DESC";

        $run = $this->conn->query($query);
        $rows = [];

        while ($row = $run->fetch_assoc()) {
            $rows[] = $row;
        }

        return [
            "keterangan_filter" => $filterText,
            "data" => $rows
        ];
    }
}
