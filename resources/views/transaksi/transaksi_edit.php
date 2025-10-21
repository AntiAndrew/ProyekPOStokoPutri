<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Transaksi</h2>
    <form action="index.php?action=update" method="POST" class="p-4 shadow bg-white rounded">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $data['harga'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
    </form>
</div>
</body>
</html>
