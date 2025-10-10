<!DOCTYPE html>
<html>
<head><title>Edit Barang</title></head>
<body>
<h2>Edit Barang</h2>
<form method="post" action="index.php?action=updateBarang">
    <input type="hidden" name="id" value="<?= $barang['id'] ?>">
    Nama: <input type="text" name="nama" value="<?= $barang['nama'] ?>"><br>
    Harga: <input type="number" name="harga" value="<?= $barang['harga'] ?>"><br>
    Stok: <input type="number" name="stok" value="<?= $barang['stok'] ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="index.php?action=lihatDaftarBarang">Kembali</a>
</body>
</html>
