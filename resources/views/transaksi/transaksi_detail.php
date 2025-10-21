<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Detail Transaksi</h2>
    <div class="card p-4 shadow bg-white">
        <p><strong>Nama Barang:</strong> <?= $data['nama_barang'] ?></p>
        <p><strong>Harga:</strong> Rp <?= number_format($data['harga'], 0, ',', '.') ?></p>
        <p><strong>Jumlah:</strong> <?= $data['jumlah'] ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($data['total'], 0, ',', '.') ?></p>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</body>
</html>
