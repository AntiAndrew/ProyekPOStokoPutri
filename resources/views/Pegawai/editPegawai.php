<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pegawai</title>
    <style>
        
</head>
<body>

    <h2>Edit Data Pegawai</h2>
    <form method="post" action="index.php?action=updatePegawai&id=<?= $pegawai['idPegawai'] ?>">
        <label>Nama Pegawai</label>
        <input type="text" name="namaPegawai" value="<?= $pegawai['namaPegawai'] ?>" required>

        <label>ID Pegawai</label>
        <input type="number" name="idPegawai" value="<?= $pegawai['idPegawai'] ?>" readonly>

        <label>Jenis Kelamin</label>
        <input type="text" name="jenisKelamin" value="<?= $pegawai['jenisKelamin'] ?>" required>

        <label>Umur</label>
        <input type="number" name="umurPegawai" value="<?= $pegawai['umurPegawai'] ?>" required>

        <div class="buttons">
            <a href="index.php?action=lihatDaftarPegawai">Kembali</a>
            <button type="submit">Update</button>
        </div>
    </form>

</body>
</html>
