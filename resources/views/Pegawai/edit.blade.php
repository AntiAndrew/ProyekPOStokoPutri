@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')
<style>
body { background-color:#f4f4f5; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color:#111827; }
.screen-area { width:100%; max-width:600px; background-color:#ffffff; padding:25px 40px; box-shadow:0 6px 18px rgba(17,24,39,0.06); margin:30px auto; border-radius:12px; }
.header { text-align:center; margin-bottom:25px; border-bottom:2px solid #e5e7eb; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#111827; }
.form-group { margin-bottom:20px; }
.form-group label { display:block; margin-bottom:5px; font-weight:600; color:#374151; }
.form-group input, .form-group select { width:100%; padding:10px; border:1px solid #d1d5db; border-radius:6px; font-size:16px; background-color:#ffffff; color:#111827; }
.form-group input[readonly] { background-color:#f8fafc; }
.form-btn { text-align:center; margin-top:30px; }
.btn { padding:12px 30px; border:none; border-radius:6px; cursor:pointer; font-weight:700; font-size:15px; margin:0 10px; }
.btn-primary { background-color:#111827; color:#ffffff; }
.btn-primary:hover { background-color:#0b1220; }
.btn-secondary { background-color:#6b7280; color:#ffffff; text-decoration:none; display:inline-block; padding:12px 30px; border-radius:6px; }
.alert { padding:15px; margin-bottom:20px; border:1px solid transparent; border-radius:6px; }
.alert-danger { color:#7f1d1d; background-color:#fff1f2; border-color:#fecaca; }
.alert-success { color:#064e3b; background-color:#ecfdf5; border-color:#bbf7d0; }
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
