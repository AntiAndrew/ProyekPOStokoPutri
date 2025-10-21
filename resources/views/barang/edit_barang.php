<?php include 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Barang</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Edit Barang</h2>
<table>
<tr>
    <th>No</th><th>ID</th><th>Nama Barang</th><th>Kategori</th><th>Harga</th><th>Jumlah</th><th>Aksi</th>
</tr>
<?php
$data = mysqli_query($conn, "SELECT * FROM barang");
$no=1;
while($d = mysqli_fetch_array($data)){
    echo "<tr>
        <td>$no</td>
        <td>$d[id_barang]</td>
        <td>$d[nama_barang]</td>
        <td>$d[kategori]</td>
        <td>Rp.$d[harga]</td>
        <td>$d[jumlah]</td>
        <td><a href='edit_barang_form.php?id=$d[id_barang]'>✏️</a></td>
    </tr>";
    $no++;
}
?>
</table>
<a href="index.php">Kembali</a>
</body>
</html>
