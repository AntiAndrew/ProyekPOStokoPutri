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
    @php
        $isCollection = (is_object($pegawai) && method_exists($pegawai, 'count')) || (is_array($pegawai));
    @endphp

    @if($isCollection)
        @forelse ($pegawai as $p)
            <tr>
                <td>{{ $p->idPegawai }}</td>
                <td>{{ $p->namaPegawai }}</td>
                <td>{{ $p->jenisKelamin }}</td>
                <td>{{ $p->umur }}</td>
                <td>
                    <a href="{{ url('pegawai/'.$p->idPegawai.'/edit') }}">✏️ Edit</a> |
                    <form action="{{ url('pegawai/'.$p->idPegawai) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus pegawai ini?')" style="cursor:pointer;">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada data pegawai yang terdaftar.</td>
            </tr>
        @endforelse
    @else
        @if($pegawai)
            <tr>
                <td>{{ $pegawai->idPegawai }}</td>
                <td>{{ $pegawai->namaPegawai }}</td>
                <td>{{ $pegawai->jenisKelamin }}</td>
                <td>{{ $pegawai->umur }}</td>
                <td>
                    <a href="{{ url('pegawai/'.$pegawai->idPegawai.'/edit') }}">✏️ Edit</a> |
                    <form action="{{ url('pegawai/'.$pegawai->idPegawai) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus pegawai ini?')" style="cursor:pointer;">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
        @else
            <tr>
                <td colspan="5">Belum ada data pegawai yang terdaftar.</td>
            </tr>
        @endif
    @endif
    </tbody>
</table>

<br>
<a href="{{ url('/') }}">⬅️ Kembali</a>

</body>
</html>
