<?php
// Pastikan file ini berisi koneksi ke database 'pos_toko_putri'
include 'config/database.php';

// Pastikan koneksi berhasil
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

// Tambahkan fungsi untuk membersihkan output (pencegahan XSS)
function clean_output($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
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
    <input type="text" name="q" placeholder="Masukkan Nama / Kode Barang" value="<?php echo isset($_GET['q']) ? clean_output($_GET['q']) : ''; ?>">
    <button type="submit">Cari</button>
</form>
<br>

<?php
// Hanya proses jika parameter 'q' ada dan tidak kosong
if (isset($_GET['q']) && !empty(trim($_GET['q']))) {
    // Ambil input dan bersihkan (walaupun Prepared Statement sudah mengamankan)
    $search_term = trim($_GET['q']);
    
    // 1. Tambahkan wildcard '%' ke input
    $q_like = '%' . $search_term . '%';

    // 2. Tulis query dengan placeholder (?)
    $sql = "SELECT id_barang, nama_barang, harga_jual, stok FROM barang 
            WHERE nama_barang LIKE ? OR id_barang LIKE ?";

    // 3. Persiapkan statement
    $stmt = mysqli_prepare($conn, $sql);

    // Cek jika prepare gagal
    if (!$stmt) {
        die('MySQL prepare error: ' . mysqli_error($conn));
    }

    // 4. Bind (ikat) parameter: "ss" berarti 2 string
    mysqli_stmt_bind_param($stmt, "ss", $q_like, $q_like);

    // 5. Eksekusi statement
    mysqli_stmt_execute($stmt);

    // 6. Ambil hasilnya
    $result = mysqli_stmt_get_result($stmt);

    echo "<h3>Hasil Pencarian untuk: " . clean_output($search_term) . "</h3>";
    
    // Cek jumlah baris yang ditemukan
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<thead><tr><th>ID Barang</th><th>Nama Barang</th><th>Harga Jual</th><th>Stok</th></tr></thead>";
        echo "<tbody>";

        // 7. Loop dan tampilkan hasil dalam tabel
        while($d = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . clean_output($d['id_barang']) . "</td>";
            echo "<td>" . clean_output($d['nama_barang']) . "</td>";
            echo "<td>Rp " . number_format($d['harga_jual'], 0, ',', '.') . "</td>";
            echo "<td>" . clean_output($d['stok']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>❌ Barang dengan nama/kode **'" . clean_output($search_term) . "'** tidak ditemukan.</p>";
    }

    // 8. Tutup statement
    mysqli_stmt_close($stmt);
} else if (isset($_GET['q']) && empty(trim($_GET['q']))) {
    echo "<p>Silakan masukkan kata kunci untuk mencari barang.</p>";
}
?>
<br>
<a href="index.php">⬅️ Kembali ke Menu Utama</a>
</body>
</html>