<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cari Pegawai</title>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<h2>Cari Pegawai</h2>

{{-- Form Pencarian --}}
<form method="GET" action="{{ url('pegawai/search') }}">
    <input type="text" name="keyword" placeholder="Masukkan Nama / ID Pegawai"
           value="{{ request('keyword') }}">
    <button type="submit">Cari</button>
</form>
<br>

{{-- Jika keyword ada --}}
@if(request('keyword'))
    <h3>Hasil Pencarian untuk: <b>{{ request('keyword') }}</b></h3>

    @if($pegawai->count() > 0)
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                </tr>
            </thead>
            <tbody>
            @foreach($pegawai as $p)
                <tr>
                    <td>{{ $p->idPegawai }}</td>
                    <td>{{ $p->namaPegawai }}</td>
                    <td>{{ $p->jenisKelamin }}</td>
                    <td>{{ $p->umurPegawai }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>❌ Pegawai dengan nama/ID <b>"{{ request('keyword') }}"</b> tidak ditemukan.</p>
    @endif
@else
    <p>Silakan masukkan kata kunci untuk mencari pegawai.</p>
@endif

<br>
<a href="{{ url('pegawai') }}">⬅️ Kembali ke Daftar Pegawai</a>

</body>
</html>