@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Input Pegawai Baru</h2>

    {{-- Tampilkan error jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong><br>
            @foreach ($errors->all() as $error)
                - {{ $error }} <br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('pegawai.store') }}">
        @csrf

        <div class="mb-3">
            <label>ID Pegawai</label>
            <input type="text" name="id_pegawai" class="form-control" required value="{{ old('id_pegawai') }}">
        </div>

        <div class="mb-3">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control" required value="{{ old('nama_pegawai') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Umur</label>
            <input type="number" name="umur" class="form-control" min="0" required value="{{ old('umur') }}">
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

    </form>
</div>
@endsection
