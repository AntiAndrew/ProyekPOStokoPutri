<?php include 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cari Barang</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Cari Barang</h2>
<form method="get">
    <input type="text" name="q" placeholder="Masukkan Nama / Kode Barang">
    <button type="submit">Cari</button>
</form>
<br>
<?php
if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $data = mysqli_query($conn, "SELECT * FROM barang WHERE nama_barang LIKE '%$q%' OR id_barang LIKE '%$q%'");
    echo "<h3>Hasil Pencarian:</h3>";
    echo "<ul>";
    while($d = mysqli_fetch_array($data)){
        echo "<li>$d[nama_barang] (ID: $d[id_barang])</li>";
    }
    echo "</ul>";
}
?>
<a href="index.php">Kembali</a>
</body>
</html>
