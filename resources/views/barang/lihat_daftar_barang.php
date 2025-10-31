<?php
// Pastikan file ini berisi koneksi ke database Anda
include 'config/database.php';

// Fungsi untuk mencegah XSS (Cross-Site Scripting)
function clean_output($data) {
    // Menggunakan operator null coalescing (??) untuk menangani nilai null dengan aman
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8'); 
}

// Fungsi untuk memformat mata uang Rupiah
function format_rupiah($angka) {
    // Memastikan input adalah angka dan mengembalikannya dalam format Rupiah
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Persiapan query
// Tambahkan kolom yang dibutuhkan (disini menggunakan asumsi kolom sebelumnya: id_barang, nama_barang, jumlah, harga)
$sql = "SELECT id_barang, nama_barang, jumlah, harga FROM barang ORDER BY nama_barang ASC";
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
<title>Lihat Daftar Barang</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Lihat Daftar Barang</h2>
<table border="1" cellpadding="10" cellspacing="0">
<thead>
    <tr>
        <th>Nama Barang</th>
        <th>Kode/ID</th>
        <th>Jumlah Stok</th>
        <th>Harga Barang (Rp)</th>
    </tr>
</thead>
<tbody>
<?php
// Menggunakan mysqli_fetch_assoc untuk kemudahan akses dengan nama kolom
if (mysqli_num_rows($data) > 0) {
    while($d = mysqli_fetch_assoc($data)){
        
        // Bersihkan semua data sebelum ditampilkan (Pencegahan XSS)
        $nama_barang_aman = clean_output($d['nama_barang']);
        $id_barang_aman = clean_output($d['id_barang']);
        $jumlah_aman = clean_output($d['jumlah']);
        $harga_format = format_rupiah($d['harga']); // Format Rupiah
        
        echo "<tr>";
        echo "<td>" . $nama_barang_aman . "</td>";
        echo "<td>" . $id_barang_aman . "</td>";
        echo "<td>" . $jumlah_aman . "</td>";
        echo "<td>" . $harga_format . "</td>";
        echo "</tr>";
    }
} else {
    // Tampilkan pesan jika tidak ada data
    echo "<tr><td colspan='4'>Belum ada data barang yang terdaftar di sistem.</td></tr>";
}
?>
</tbody>
</table>
<br>
<a href="index.php">⬅️ Kembali</a>
</body>
</html>