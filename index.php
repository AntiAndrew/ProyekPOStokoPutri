<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi Penjualan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <header class="text-center mb-4">
        <h1>💰 Daftar Transaksi Penjualan</h1>
        <a href="index.php" class="btn btn-secondary mt-2">← Kembali ke Dashboard</a>
    </header>

    <a href="transaksi_form.php" class="btn btn-success mb-3">+ Tambah Transaksi</a>

    <?php
    // --- koneksi database ---
    include 'koneksi.php';  // pastikan file koneksi sudah benar
    $query = "SELECT * FROM transaksi ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td>{$row['jumlah']}</td>
                        <td>Rp " . number_format($row['harga'] * $row['jumlah'], 0, ',', '.') . "</td>
                        <td>
                            <a href='transaksi_edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='transaksi_delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Belum ada data transaksi</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
