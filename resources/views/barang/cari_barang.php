<!DOCTYPE html>
<html>
<head><title>Cari Barang</title></head>
<body>
<h2>Hasil Pencarian Barang</h2>
<a href="index.php?action=lihatDaftarBarang">Kembali</a>
<table border="1" cellpadding="5" cellspacing="0">
<tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th></tr>
<?php while ($row = $data->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['harga'] ?></td>
    <td><?= $row['stok'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
