<!DOCTYPE html>
<html>
<head>
    <title>Lihat Daftar Barang</title>
</head>
<body>
<h2>Daftar Barang</h2>
<a href="index.php?action=inputBarang">+ Input Barang</a>

<form method="get" action="index.php">
    <input type="hidden" name="action" value="cariBarang">
    <input type="text" name="keyword" placeholder="Cari barang...">
    <button type="submit">Cari</button>
</form>

<table border="1" cellpadding="5" cellspacing="0">
<tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
<?php while ($row = $data->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['harga'] ?></td>
    <td><?= $row['stok'] ?></td>
    <td>
        <a href="index.php?action=editBarang&id=<?= $row['id'] ?>">Edit</a> |
        <a href="index.php?action=hapusBarang&id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
