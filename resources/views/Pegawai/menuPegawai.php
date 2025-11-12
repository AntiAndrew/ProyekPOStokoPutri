<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Menu Kelola Pegawai</title>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<h2>Menu Kelola Pegawai</h2>

<div style="text-align:center; margin-bottom:20px;">
    <input type="text" placeholder="Cari Pegawai..." class="search-box">
</div>

<div class="menu-container">

    <a href="{{ url('pegawai/create') }}" class="menu-card green">
        <div class="icon">👤➕</div>
        Tambah Pegawai Baru
    </a>

    <a href="{{ url('pegawai') }}" class="menu-card blue">
        <div class="icon">📋</div>
        Lihat Daftar Pegawai
    </a>

    <a href="{{ url('pegawai/edit') }}" class="menu-card yellow">
        <div class="icon">✏️</div>
        Edit Pegawai
    </a>

    <a href="{{ url('pegawai/delete') }}" class="menu-card red">
        <div class="icon">🗑️</div>
        Hapus Pegawai
    </a>

    <a href="{{ url('pegawai/search') }}" class="menu-card purple">
        <div class="icon">🔍</div>
        Cari Pegawai
    </a>

</div>

<style>
.menu-container {
    display: grid;
    grid-template-columns: repeat(3, 200px);
    gap: 15px;
    justify-content: center;
}

.menu-card {
    padding: 20px;
    border-radius: 10px;
    font-weight: bold;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    font-size: 15px;
    text-decoration: none;
    color: #000;
}
.green { background:#c8f7c5; }
.blue { background:#cfe9ff; }
.yellow { background:#ffe7a0; }
.red { background:#f8c0c0; }
.purple { background:#e2d4ff; }

.icon { font-size: 28px; margin-bottom:10px; }
</style>

</body>
</html>
