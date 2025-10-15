<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #e8f0d9;
            font-family: "Poppins", sans-serif;
        }

        .container {
            max-width: 600px;
            margin-top: 60px;
            background-color: #f7f9f2;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: 1px 1px 4px rgba(0,0,0,0.1);
        }

        .btn-custom {
            width: 100px;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .top-icons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .icon-btn {
            border: none;
            background: none;
            font-size: 1.4rem;
            color: black;
        }

        .icon-btn:hover {
            color: #4b6d2e;
        }

        .user-icon {
            font-size: 1.6rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Icons -->
        <div class="top-icons mb-2">
            <div>
                <button class="icon-btn" onclick="window.history.back()">
                    <i class="bi bi-arrow-left-circle"></i>
                </button>
                <a href="/" class="icon-btn"><i class="bi bi-house-door"></i></a>
            </div>
            <i class="bi bi-person-circle user-icon"></i>
        </div>

        <!-- Form Title -->
        <h2>Input Data Pegawai</h2>

        <!-- Form -->
        <form action="{{ route('pegawai.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="mb-3">
                <label for="idPegawai" class="form-label">ID Pegawai</label>
                <input type="text" class="form-control" id="idPegawai" name="idPegawai" required>
            </div>

            <div class="mb-3">
                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control" id="jenisKelamin" name="jenisKelamin" required>
            </div>

            <div class="mb-3">
                <label for="umur" class="form-label">Umur</label>
                <input type="number" class="form-control" id="umur" name="umur" required>
            </div>

            <div class="btn-wrapper">
                <button type="button" class="btn btn-light btn-custom" onclick="window.history.back()">Kembali</button>
                <button type="reset" class="btn btn-light btn-custom">Batal</button>
                <button type="submit" class="btn btn-success btn-custom">Simpan</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
