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

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Penjualan</title>
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #dfe8f7;
    }
    .container {
        width: 90%;
        margin: 30px auto;
        background-color: #e9edd8;
        border-radius: 10px;
        padding: 20px;
    }
    h2 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th, td {
        border: 1px solid #aaa;
        padding: 8px;
        text-align: center;
    }
    th {
        background-color: #ccc;
    }
    .filter {
        margin-bottom: 10px;
    }
    .radio {
        margin: 5px 0;
    }
    .btn {
        background-color: #4c6ef5;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #365edb;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Laporan Penjualan</h2>

    <form method="POST" class="filter">
        <p><strong>Rentang Waktu:</strong></p>
        <div class="radio">
            <label><input type="radio" name="rentang" value="hari_ini"> Hari Ini</label><br>
            <label><input type="radio" name="rentang" value="7_hari"> 7 Hari Terakhir</label><br>
            <label><input type="radio" name="rentang" value="bulan"> Pilih Bulan:
                <select name="bulan">
                    <?php for ($i = 1; $i <= 12; $i++) echo "<option value='$i'>$i</option>"; ?>
                </select>
                <select name="tahun">
                    <?php for ($y = 2023; $y <= date('Y'); $y++) echo "<option value='$y'>$y</option>"; ?>
                </select>
            </label><br>
            <label><input type="radio" name="rentang" value="tanggal"> Pilih Tanggal:
                <input type="date" name="tanggal">
            </label>
        </div>
        <button type="submit" class="btn">Tampilkan</button>
    </form>

    <p><b>Menampilkan:</b> <?= $filter ?: 'Semua Data'; ?></p>

    <table>
        <tr>
            <th>Kode/ID Barang</th>
            <th>Nama Barang</th>
            <th>Metode Pembayaran</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga Barang</th>
            <th>Total Pembayaran</th>
            <th>HPP</th>
            <th>Keuntungan</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $total = $row['jumlah'] * $row['harga_barang'];
                $keuntungan = $total - ($row['hpp'] * $row['jumlah']);
                echo "<tr>
                    <td>{$row['kode_barang']}</td>
                    <td>{$row['nama_barang']}</td>
                    <td>{$row['metode_pembayaran']}</td>
                    <td>{$row['jumlah']}</td>
                    <td>{$row['satuan']}</td>
                    <td>Rp " . number_format($row['harga_barang'], 0, ',', '.') . "</td>
                    <td>Rp " . number_format($total, 0, ',', '.') . "</td>
                    <td>Rp " . number_format($row['hpp'], 0, ',', '.') . "</td>
                    <td>Rp " . number_format($keuntungan, 0, ',', '.') . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
