<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_salon");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Default query
$query = "SELECT * FROM penjualan";
$filter = "";

// Proses filter waktu
if (isset($_POST['rentang'])) {
    $rentang = $_POST['rentang'];

    if ($rentang == "hari_ini") {
        $query .= " WHERE DATE(tanggal) = CURDATE()";
        $filter = "Hari Ini";
    } elseif ($rentang == "7_hari") {
        $query .= " WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
        $filter = "7 Hari Terakhir";
    } elseif ($rentang == "bulan") {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $query .= " WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
        $filter = "Bulan $bulan-$tahun";
    } elseif ($rentang == "tanggal") {
        $tgl = $_POST['tanggal'];
        $query .= " WHERE tanggal = '$tgl'";
        $filter = "Tanggal $tgl";
    }
}

$result = $conn->query($query);
?>

