<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lihat Daftar Pegawai</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<h2>Daftar Pegawai</h2>

<a href="{{ url('pegawai/create') }}">+ Input Pegawai</a>

{{-- Form Cari Pegawai --}}
<form method="GET" action="{{ url('pegawai/search') }}">
    <input type="text" name="keyword" placeholder="Cari pegawai..." value="{{ request('keyword') }}">
    <button type="submit">Cari</button>
</form>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID Pegawai</th>
            <th>Nama Pegawai</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    @forelse ($pegawai as $p)
        <tr>
            <td>{{ $p->id_pegawai }}</td>
            <td>{{ $p->nama_pegawai }}</td>
            <td>{{ $p->jenis_kelamin }}</td>
            <td>{{ $p->umur_Pegawai }}</td>
            <td>
                <a href="{{ url('pegawai/'.$p->id_pegawai.'/edit') }}">✏️ Edit</a> |
                
                {{-- Hapus dengan form supaya sesuai method DELETE Laravel --}}
                <form action="{{ url('pegawai/'.$p->id_pegawai) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Yakin hapus pegawai ini?')" style="cursor:pointer;">
                        🗑️ Hapus
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">Belum ada data pegawai yang terdaftar.</td>
        </tr>
    @endforelse
    </tbody>
</table>

<br>
<a href="{{ url('/') }}">⬅️ Kembali</a>

</body>
</html>
