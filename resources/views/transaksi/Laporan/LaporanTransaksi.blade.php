// LaporanTransaksi.php
session_start();
// contoh proteksi login (opsional)
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = "User Account"; // sementara biar tampil
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
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
            min-height: 80vh;
            margin: 40px auto;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Header */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
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

        .icon-btn:hover {
            transform: scale(1.1);
        }

        .search-box {
            flex: 1;
            display: flex;
            align-items: center;
            margin: 0 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
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

        /* Layout utama */
        .content {
            display: flex;
            flex: 1;
            gap: 30px;
            flex-wrap: wrap;
        }

        .sidebar {
            flex: 1 1 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            padding-right: 10px;
            border-right: 2px solid black;
        }

        .sidebar button {
            background-color: #d2b48c;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
            font-weight: bold;
            cursor: pointer;
        }

        .sidebar button:hover {
            background-color: #c4a77b;
        }

        .logout {
            background-color: #f2f2f2 !important;
            margin-top: auto;
        }

        /* Area kanan */
        .main-content {
            flex: 3;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background-color: #fbbd4b;
            border-radius: 10px;
            box-shadow: 3px 3px 6px rgba(0,0,0,0.2);
            padding: 30px;
            text-align: center;
            width: 180px;
            transition: transform 0.2s;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 70px;
            height: 70px;
            margin-bottom: 10px;
        }

        .card p {
            font-weight: 600;
            color: #333;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .content {
                flex-direction: column;
                align-items: center;
            }

            .sidebar {
                border-right: none;
                border-bottom: 2px solid black;
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
                padding-bottom: 15px;
            }

            .main-content {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header -->
        <div class="topbar">
            <div class="left-icons">
                <button class="icon-btn" onclick="window.location.href='dashboard.php'">⬅</button>
                <button class="icon-btn" onclick="window.location.href='home.php'">🏠</button>
            </div>

            <div class="search-box">
                <input type="text" placeholder="Cari...">
            </div>

            <button class="account-btn" onclick="window.location.href='account.php'">
                👤 <?php echo $_SESSION['user']; ?>
            </button>
        </div>

        <!-- Konten utama -->
        <div class="content">
            <!-- Sidebar -->
            <div class="sidebar">
                <button onclick="window.location.href='laporan_transaksi.php'">Laporan Transaksi</button>
                <button class="logout" onclick="window.location.href='logout.php'">Logout</button>
            </div>

            <!-- Main content -->
            <div class="main-content">
                <div class="card" onclick="window.location.href='laporan_penjualan.php'">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135695.png" alt="icon laporan">
                    <p>Laporan Penjualan</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
