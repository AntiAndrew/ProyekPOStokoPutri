<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang</title>
    
</head>
<body>

    <h2>Input Barang Baru</h2>
    <form method="post" action="index.php?action=simpanBarang">
        <label>Nama Pegawai</label>
        <input type="text" name="namaPegawai" required>

        <label>ID Pegawai</label>
        <input type="number" name="idPegawai" required>

        <label>Jenis Kelamin</label>
        <input type="text" name="jenisKelamin" required>

        <label>Umur</label>
        <input type="number" name="umurPegawai" required>

        <div class="buttons">
            <a href="index.php?action=lihatDaftarPegawai">Kembali</a>
            <button type="submit">Simpan</button>
        </div>
    </form>

</body>
</html>
