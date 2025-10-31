<?php 
// Hanya sertakan file konfigurasi database jika memang ada logika PHP/data
// yang membutuhkannya di halaman menu ini. Jika tidak ada, baris ini bisa dihilangkan.
include 'config/database.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Barang | Menu Utama</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>🛍️ Kelola Barang</h1>
        <a href="index.php" class="back-button">← Kembali ke Dashboard</a>
    </header>
    
    <hr>
    
    <div class="menu-grid">
        <a href="input_barang.php" class="menu-card menu-create">
            <img src="assets/img/input.png" alt="Ikon Input Barang">
            <p>Input Barang</p>
        </a>
        
        <a href="edit_barang.php" class="menu-card menu-update">
            <img src="assets/img/edit.png" alt="Ikon Edit Barang">
            <p>Edit Barang</p>
        </a>
        
        <a href="hapus_barang.php" class="menu-card menu-delete">
            <img src="assets/img/delete.png" alt="Ikon Hapus Barang">
            <p>Hapus Barang</p>
        </a>
        
        <a href="cari_barang.php" class="menu-card menu-search">
            <img src="assets/img/search.png" alt="Ikon Cari Barang">
            <p>Cari Barang</p>
        </a>
        
        <a href="lihat_barang.php" class="menu-card menu-read">
            <img src="assets/img/list.png" alt="Ikon Daftar Barang">
            <p>Lihat Daftar Barang</p>
        </a>
    </div>
    
    <footer>
        </footer>
</div>
</body>
</html>