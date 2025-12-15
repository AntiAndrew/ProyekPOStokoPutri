@extends('layouts.app')
@section('title','Daftar Pegawai')

@section('content')
<h2>Daftar Pegawai</h2>

<a href="{{ route('pegawai.create') }}">+ Input Pegawai</a>

{{-- Form Cari Pegawai --}}
<form method="GET" action="{{ route('pegawai.cari') }}">
    <input type="text" name="keyword" placeholder="Cari pegawai..." value="{{ request('keyword') }}">
    <button type="submit">Cari</button>
    @if(request('jenisKelamin'))
      <input type="hidden" name="jenisKelamin" value="{{ request('jenisKelamin') }}">
    @endif
</form>

<table class="table table-bordered">
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
                    <a href="{{ route('pegawai.edit', $p->idPegawai) }}">✏️ Edit</a> |
                    <form action="{{ route('pegawai.destroy', $p->idPegawai) }}" method="POST" style="display:inline;">
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
                    <a href="{{ route('pegawai.edit', $pegawai->idPegawai) }}">✏️ Edit</a> |
                    <form action="{{ route('pegawai.destroy', $pegawai->idPegawai) }}" method="POST" style="display:inline;">
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

@endsection
