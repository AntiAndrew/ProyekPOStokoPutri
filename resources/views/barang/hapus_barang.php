<?php
// Pastikan file ini berisi koneksi ke database Anda
include 'config/database.php';

// Fungsi untuk mencegah XSS (Cross-Site Scripting)
function clean_output($data) {
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

// Persiapan query untuk menampilkan daftar
$sql = "SELECT id_barang, nama_barang, kategori FROM barang ORDER BY id_barang ASC";
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
<title>Hapus Barang</title>
<link rel="stylesheet" href="assets/css/style.css">
<style>
/* Style tambahan untuk membuat tombol POST terlihat seperti tautan atau ikon */
.delete-form {
    display: inline-block; /* Penting agar tidak merusak tata letak tabel */
    margin: 0;
    padding: 0;
}
.delete-form button {
    background: none;
    border: none;
    color: red; /* Warna untuk ikon/tombol hapus */
    cursor: pointer;
    font-size: 1em; /* Ukuran yang sesuai dengan ikon */
    padding: 0;
}
</style>
</head>
<body>
<h2>Hapus Barang</h2>
<table border="1" cellpadding="10" cellspacing="0">
<thead>
    <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>ID</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php
$no = 1;

// Cek jika ada data
if (mysqli_num_rows($data) > 0) {
    while($d = mysqli_fetch_assoc($data)){
        // Bersihkan semua data sebelum ditampilkan (Pencegahan XSS)
        $id_barang_aman = clean_output($d['id_barang']);
        $nama_barang_aman = clean_output($d['nama_barang']);
        $kategori_aman = clean_output($d['kategori']);
        
        echo "<tr>";
        echo "<td>" . $no . "</td>";
        echo "<td>" . $nama_barang_aman . "</td>";
        echo "<td>" . $kategori_aman . "</td>";
        echo "<td>" . $id_barang_aman . "</td>";
        
        // Menggunakan Formulir POST untuk HAPUS (Lebih Aman dari CSRF)
        echo "<td>";
        echo "<form method='POST' action='hapus_proses.php' class='delete-form' onsubmit='return confirm(\"ANDA YAKIN INGIN MENGHAPUS BARANG: " . addslashes($nama_barang_aman) . "? Aksi ini TIDAK DAPAT dibatalkan.\")'>";
        // Input tersembunyi untuk mengirim ID barang
        echo "<input type='hidden' name='id' value='" . $id_barang_aman . "'>";
        // Tombol submit yang terlihat seperti ikon
        echo "<button type='submit' title='Hapus Barang Ini'>🗑️ Hapus</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='5'>Tidak ada data barang yang dapat dihapus.</td></tr>";
}
?>
</tbody>
</table>
<br>
<a href="index.php">⬅️ Kembali</a>
</body>
</html>