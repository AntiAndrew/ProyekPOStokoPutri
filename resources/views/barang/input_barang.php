<!DOCTYPE html>
<html>
<head><title>Input Barang</title></head>
<body>
<h2>Input Barang Baru</h2>
<form method="post" action="index.php?action=simpanBarang">
    Nama: <input type="text" name="nama" required><br>
    Harga: <input type="number" name="harga" required><br>
    Stok: <input type="number" name="stok" required><br>
    <button type="submit">Simpan</button>
</form>
<a href="index.php?action=lihatDaftarBarang">Kembali</a>
</body>
</html>
