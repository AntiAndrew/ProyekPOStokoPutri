<?php
// Koneksi DB
include 'config/database.php';

// Anti XSS
function clean_output($data) {
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

// Ambil ID Pegawai dari URL
$id = isset($_GET['id']) ? $_GET['id'] : exit("ID pegawai tidak ditemukan!");

// Query data pegawai yang dipilih
$sql = "SELECT id_pegawai, nama_pegawai, jenis_kelamin, umur FROM pegawai WHERE id_pegawai = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Jika tidak ditemukan
if(mysqli_num_rows($result) == 0) {
    exit("❌ Data pegawai tidak ditemukan!");
}

$pegawai = mysqli_fetch_assoc($result);

// Proses Update
if(isset($_POST['update'])) {
    $nama = clean_output($_POST['nama_pegawai']);
    $jenis = clean_output($_POST['jenis_kelamin']);
    $umur = filter_var($_POST['umur'], FILTER_VALIDATE_INT);

    if(!$umur || $umur < 1){
        $error = "Umur harus angka positif!";
    } else {
        $update = "UPDATE pegawai SET nama_pegawai=?, jenis_kelamin=?, umur=? WHERE id_pegawai=?";
        $stmt2 = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($stmt2, "ssis", $nama, $jenis, $umur, $id);

        if(mysqli_stmt_execute($stmt2)) {
            echo "<script>alert('✅ Data pegawai berhasil diupdate'); window.location='lihatPegawai.php';</script>";
            exit;
        } else {
            $error = "❌ Gagal update data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Pegawai</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h2>Edit Data Pegawai</h2>

<?php if(isset($error)) echo "<p style='color:red'><b>$error</b></p>"; ?>

<form method="post">
    <label>ID Pegawai</label>
    <input type="text" name="idPegawai" value="<?= clean_output($pegawai['idPegawai']) ?>" readonly>

    <label>Nama Pegawai</label>
    <input type="text" name="namaPegawai" required value="<?= clean_output($pegawai['namaPegawai']) ?>">

    <label>Jenis Kelamin</label>
    <select name="jenisKelamin" required>
        <?php $jk = clean_output($pegawai['jenisKelamin']); ?>
        <option value="Laki-laki" <?= $jk=="Laki-laki"?"selected":""; ?>>Laki-laki</option>
        <option value="Perempuan" <?= $jk=="Perempuan"?"selected":""; ?>>Perempuan</option>
    </select>

    <label>Umur Pegawai</label>
    <input type="number" min="1" name="umurPegawai" value="<?= clean_output($pegawai['umurPegawai']) ?>" required>

    <div class="form-btn">
        <button type="submit" name="update">Update</button>
        <a href="lihatPegawai.php">Kembali</a>
    </div>
</form>

</body>
</html>
