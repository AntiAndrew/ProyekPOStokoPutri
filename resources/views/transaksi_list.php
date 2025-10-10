<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar Transaksi Penjualan</h2>
    <a href="index.php?action=form" class="btn btn-success mb-3">+ Tambah Transaksi</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td>{$row['jumlah']}</td>
                        <td>Rp " . number_format($row['total'], 0, ',', '.') . "</td>
                    </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
