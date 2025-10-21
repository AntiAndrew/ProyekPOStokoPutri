<?php include 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Input Barang</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Input Barang</h2>
<form method="post">
    <label>ID Barang</label>
    <input type="text" name="id_barang" required>
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" required>
    <label>Kategori</label>
    <select name="kategori">
        <option value="Makanan">Makanan</option>
        <option value="Minuman">Minuman</option>
        <option value="Alat rumah tangga">Alat rumah tangga</option>
    </select>
    <label>Harga Barang</label>
    <input type="number" name="harga" required>
    <label>Jumlah Barang</label>
    <input type="number" name="jumlah" required>

    <div class="form-btn">
        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php">Kembali</a>
    </div>
</form>

<?php
if (isset($_POST['simpan'])) {
    $id = $_POST['id_barang'];
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($conn, "INSERT INTO barang VALUES('$id','$nama','$kategori','$harga','$jumlah')");
    echo "<script>alert('Barang berhasil ditambahkan!'); window.location='lihat_barang.php';</script>";
}
?>
</body>
</html>
