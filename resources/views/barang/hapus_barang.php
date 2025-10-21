<?php include 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Hapus Barang</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Hapus Barang</h2>
<table>
<tr><th>No</th><th>Nama Barang</th><th>Kategori</th><th>ID</th><th>Aksi</th></tr>
<?php
$data = mysqli_query($conn, "SELECT * FROM barang");
$no=1;
while($d = mysqli_fetch_array($data)){
    echo "<tr>
        <td>$no</td>
        <td>$d[nama_barang]</td>
        <td>$d[kategori]</td>
        <td>$d[id_barang]</td>
        <td><a href='hapus_proses.php?id=$d[id_barang]' onclick='return confirm(\"Yakin hapus?\")'>🗑️</a></td>
    </tr>";
    $no++;
}
?>
</table>
<a href="index.php">Kembali</a>
</body>
</html>
