<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Pegawai</title>
</head>
<body>

<h2>Hasil Pencarian Pegawai</h2>
<a href="index.php?action=lihatDaftarPegawai">Kembali</a>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID Pegawai</th>
    <th>Nama Pegawai</th>
    <th>Jenis Kelamin</th>
    <th>Umur</th>
</tr>

<?php while ($row = $data->fetch_assoc()): ?>
<tr>
    <td><?= $row['idPegawai'] ?></td>
    <td><?= $row['namaPegawai'] ?></td>
    <td><?= $row['jenisKelamin'] ?></td>
    <td><?= $row['umurPegawai'] ?></td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>
