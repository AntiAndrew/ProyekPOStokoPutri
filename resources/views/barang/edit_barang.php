<?php
// Pastikan file ini berisi koneksi ke database Anda
include 'config/database.php';

// Fungsi untuk mencegah XSS (Cross-Site Scripting)
function clean_output($data) {
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

// Fungsi untuk memformat mata uang
function format_rupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Persiapan query
// Ganti 'harga' dan 'jumlah' dengan nama kolom yang benar jika berbeda (misalnya harga_jual, stok)
$sql = "SELECT id_barang, nama_barang, kategori, harga, jumlah FROM barang ORDER BY id_barang ASC";
$data = mysqli_query($conn, $sql);

// Cek jika query gagal
if (!$data) {
    die('Query gagal: ' . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Barang | Daftar</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Daftar Barang untuk Diedit</h2>
<table border="1" cellpadding="10" cellspacing="0">
<thead>
    <tr>
        <th>No</th>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok/Jumlah</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php
$no = 1;
// Menggunakan mysqli_fetch_assoc untuk kemudahan akses dengan nama kolom
while($d = mysqli_fetch_assoc($data)){
    // Bersihkan semua data sebelum ditampilkan
    $id_barang_aman = clean_output($d['id_barang']);
    $nama_barang_aman = clean_output($d['nama_barang']);
    $kategori_aman = clean_output($d['kategori']);
    $harga_format = format_rupiah($d['harga']);
    $jumlah_aman = clean_output($d['jumlah']);
    
    // Tautan edit: ID juga harus dibersihkan untuk URL jika diperlukan, tetapi dalam konteks ini aman karena dari database.
    $link_edit = "edit_barang_form.php?id=" . urlencode($id_barang_aman);

    echo "<tr>";
    echo "<td>" . $no . "</td>";
    echo "<td>" . $id_barang_aman . "</td>";
    echo "<td>" . $nama_barang_aman . "</td>";
    echo "<td>" . $kategori_aman . "</td>";
    echo "<td>" . $harga_format . "</td>";
    echo "<td>" . $jumlah_aman . "</td>";
    echo "<td><a href='" . $link_edit . "'>✏️ Edit</a></td>";
    echo "</tr>";
    $no++;
}

// Cek jika tidak ada data
if (mysqli_num_rows($data) == 0) {
    echo "<tr><td colspan='7'>Belum ada data barang yang terdaftar.</td></tr>";
}
?>
</tbody>
</table>
<br>
<a href="index.php">⬅️ Kembali</a>
</body>
</html>