<?php
// Pastikan file ini berisi koneksi ke database Anda
include 'config/database.php';

// Fungsi untuk mencegah XSS pada data yang mungkin ditampilkan atau diproses
function clean_output($data) {
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

// Cek apakah tombol 'simpan' telah diklik
if (isset($_POST['simpan'])) {
    // Ambil dan bersihkan input dari pengguna
    $id_barang  = clean_output($_POST['id_barang']);
    $nama_barang = clean_output($_POST['nama_barang']);
    $kategori   = clean_output($_POST['kategori']);
    // Filter input numerik untuk keamanan dan tipe data
    $harga      = filter_var($_POST['harga'], FILTER_VALIDATE_INT);
    $jumlah     = filter_var($_POST['jumlah'], FILTER_VALIDATE_INT);

    // --- Pengecekan Validasi Sederhana ---
    if (empty($id_barang) || empty($nama_barang) || $harga === false || $jumlah === false || $harga < 0 || $jumlah < 0) {
        $error_message = "❌ Error: Semua field harus diisi dengan benar. Harga dan Jumlah harus angka positif.";
    } else {
        // --- KEAMANAN: Menggunakan Prepared Statements ---
        
        // Asumsi urutan kolom di tabel 'barang' adalah: id_barang, nama_barang, kategori, harga, jumlah
        $sql = "INSERT INTO barang (id_barang, nama_barang, kategori, harga, jumlah) VALUES (?, ?, ?, ?, ?)";
        
        // 1. Persiapkan statement
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // 2. Bind parameter: 'ssiisi' (s=string, i=integer) sesuai tipe data kolom Anda
            // Asumsi: id_barang, nama_barang, kategori (string), harga, jumlah (integer)
            mysqli_stmt_bind_param($stmt, "sssid", $id_barang, $nama_barang, $kategori, $harga, $jumlah);
            
            // 3. Eksekusi statement
            if (mysqli_stmt_execute($stmt)) {
                // Berhasil
                echo "<script>alert('✅ Barang berhasil ditambahkan!'); window.location='lihat_barang.php';</script>";
                exit();
            } else {
                // Gagal, misalnya karena ID barang duplikat
                $error_message = "❌ Gagal menyimpan data: " . mysqli_error($conn);
            }
            
            // 4. Tutup statement
            mysqli_stmt_close($stmt);
        } else {
            $error_message = "❌ Database error saat mempersiapkan query.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Input Barang</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h2>Input Barang</h2>

<?php 
// Tampilkan pesan error jika ada
if (isset($error_message)) {
    echo "<p style='color: red; font-weight: bold;'>$error_message</p>";
}
?>

<form method="post">
    <label>ID Barang</label>
    <input type="text" name="id_barang" required value="<?php echo isset($_POST['id_barang']) ? clean_output($_POST['id_barang']) : ''; ?>">
    
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" required value="<?php echo isset($_POST['nama_barang']) ? clean_output($_POST['nama_barang']) : ''; ?>">
    
    <label>Kategori</label>
    <select name="kategori">
        <?php $selected_kategori = isset($_POST['kategori']) ? $_POST['kategori'] : ''; ?>
        <option value="Makanan" <?php echo $selected_kategori == 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
        <option value="Minuman" <?php echo $selected_kategori == 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
        <option value="Alat rumah tangga" <?php echo $selected_kategori == 'Alat rumah tangga' ? 'selected' : ''; ?>>Alat rumah tangga</option>
    </select>
    
    <label>Harga Barang (Rp.)</label>
    <input type="number" name="harga" required min="0" value="<?php echo isset($_POST['harga']) ? clean_output($_POST['harga']) : ''; ?>">
    
    <label>Jumlah Barang (Stok)</label>
    <input type="number" name="jumlah" required min="0" value="<?php echo isset($_POST['jumlah']) ? clean_output($_POST['jumlah']) : ''; ?>">

    <div class="form-btn">
        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php">Kembali</a>
    </div>
</form>

</body>
</html>