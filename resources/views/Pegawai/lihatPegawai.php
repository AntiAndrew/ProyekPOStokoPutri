<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lihat Daftar Pegawai</title>
</head>
<body>

<h2>Daftar Pegawai</h2>
<a href="index.php?action=inputPegawai">+ Input Pegawai</a>

<form method="get" action="index.php">
    <input type="hidden" name="action" value="cariPegawai">
    <input type="text" name="keyword" placeholder="Cari pegawai...">
    <button type="submit">Cari</button>
</form>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID Pegawai</th>
    <th>Nama Pegawai</th>
    <th>Jenis Kelamin</th>
    <th>Umur</th>
    <th>Aksi</th>
</tr>

<?php while ($row = $data->fetch_assoc()): ?>
<tr>
    <td><?= $row['idPegawai'] ?></td>
    <td><?= $row['namaPegawai'] ?></td>
    <td><?= $row['jenisKelamin'] ?></td>
    <td><?= $row['umurPegawai'] ?></td>
    <td>
        <a href="index.php?action=editPegawai&id=<?= $row['idPegawai'] ?>">Edit</a> |
        <a href="index.php?action=hapusPegawai&id=<?= $row['idPegawai'] ?>" onclick="return confirm('Yakin hapus pegawai ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
