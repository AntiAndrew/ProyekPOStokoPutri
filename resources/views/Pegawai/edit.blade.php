@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<style>
body { background-color:#e6f7ff; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
.screen-area { width:100%; max-width:600px; background-color:#f0fff0; padding:25px 40px; box-shadow:0 4px 20px rgba(0,0,0,0.1); margin:30px auto; border-radius:12px; }
.header { text-align:center; margin-bottom:25px; border-bottom:2px solid #b3e0b3; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#2e8b57; }
.form-group { margin-bottom:20px; }
.form-group label { display:block; margin-bottom:5px; font-weight:600; color:#2e8b57; }
.form-group input, .form-group select { width:100%; padding:10px; border:1px solid #ccc; border-radius:5px; font-size:16px; }
.form-group input[readonly] { background-color:#f5f5f5; }
.form-btn { text-align:center; margin-top:30px; }
.btn { padding:12px 30px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; font-size:16px; margin:0 10px; }
.btn-primary { background-color:#2e8b57; color:white; }
.btn-secondary { background-color:#6c757d; color:white; text-decoration:none; display:inline-block; padding:12px 30px; }
.alert { padding:15px; margin-bottom:20px; border:1px solid transparent; border-radius:4px; }
.alert-danger { color:#721c24; background-color:#f8d7da; border-color:#f5c6cb; }
</style>

<div class="screen-area">
    <div class="header">
        <h1 class="header-title">Edit Data Pegawai</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pegawai.update', $pegawai->idPegawai) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="idPegawai">ID Pegawai</label>
            <input type="text" id="idPegawai" name="idPegawai" value="{{ clean_output($pegawai->idPegawai) }}" readonly>
        </div>

        <div class="form-group">
            <label for="namaPegawai">Nama Pegawai</label>
            <input type="text" id="namaPegawai" name="namaPegawai" value="{{ clean_output($pegawai->namaPegawai) }}" required>
        </div>

        <div class="form-group">
            <label for="jenisKelamin">Jenis Kelamin</label>
            <select id="jenisKelamin" name="jenisKelamin" required>
                <option value="Laki-laki" {{ $pegawai->jenisKelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $pegawai->jenisKelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="umur">Umur Pegawai</label>
            <input type="number" id="umur" name="umur" min="18" value="{{ clean_output($pegawai->umur) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ clean_output($pegawai->email ?? '') }}" required>
        </div>

        <div class="form-btn">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
