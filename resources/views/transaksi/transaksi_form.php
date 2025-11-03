<!DOCTYPE html>
<html>
<head>
    <title>Form Transaksi Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Tambah Transaksi Penjualan</h2>
    <form action="index.php?action=simpan" method="POST" class="p-4 shadow rounded bg-white">
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Satuan</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Simpan Transaksi</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Lihat Daftar Transaksi</a>
    </form>
</div>
</body>
</html>
