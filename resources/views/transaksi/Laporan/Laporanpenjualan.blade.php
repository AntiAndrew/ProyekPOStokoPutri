<?php
// laporan_penjualan.php
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = "User Account"; // sementara untuk demo
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            margin: 0;
            background-color: #b7ccf4; /* biru muda */
        }

        .container {
            background-color: #eaf1d8; /* hijau muda */
            width: 90%;
            max-width: 1200px;
            min-height: 85vh;
            margin: 40px auto;
            border-radius: 10px;
            padding: 25px;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-icons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 22px;
        }

        .title {
            font-weight: 700;
            font-size: 22px;
            text-align: center;
            flex: 1;
        }

        .account-btn {
            background-color: #1b62b8;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        /* Filter rentang waktu */
        .filter {
            margin-top: 30px;
            margin-left: 30px;
        }

        .filter h4 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .filter label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-size: 15px;
        }

        input[type="radio"] {
            accent-color: #1b62b8;
            transform: scale(1.1);
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 14px;
            text-align: center;
        }

        th {
            background-color: #efefef;
            font-weight: 600;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 6px;
            }

            .filter {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="topbar">
            <div class="left-icons">
                <button class="icon-btn" onclick="window.location.href='laporan.php'">⬅</button>
                <button class="icon-btn" onclick="window.location.href='home.php'">🏠</button>
            </div>

            <div class="title">Laporan Penjualan</div>

            <button class="account-btn" onclick="window.location.href='account.php'">
                👤 <?php echo $_SESSION['user']; ?>
            </button>
        </div>

        <!-- Filter rentang waktu -->
        <div class="filter">
            <h4>Rentan Waktu</h4>
            <label><span>Hari Ini</span><input type="radio" name="rentan" value="hari_ini"></label>
            <label><span>7 Hari Terakhir</span><input type="radio" name="rentan" value="7_hari"></label>
            <label><span>Pilih Bulan</span><input type="radio" name="rentan" value="bulan"></label>
            <label><span>Pilih Tanggal</span><input type="radio" name="rentan" value="tanggal"></label>
        </div>

        <!-- Tabel laporan -->
        <table>
            <thead>
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
            </thead>
            <tbody>
                <?php 
                // contoh data statis, bisa diganti dengan query dari database
                $data = [
                    ["BRG001", "Shampoo Lavender", "Cash", 3, "Botol", 35000, 105000, 70000, 35000],
                    ["BRG002", "Hair Dryer Mini", "Transfer", 1, "Unit", 150000, 150000, 120000, 30000],
                ];

                foreach($data as $row){
                    echo "<tr>";
                    foreach($row as $col){
                        echo "<td>$col</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
