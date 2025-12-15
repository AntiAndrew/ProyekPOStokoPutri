@extends('layouts.dashboard')
@section('title','Input Pegawai')
@section('page-title','Input Pegawai')

@section('content')
<div class="form-page">
  <div class="form-container">
    <h2 class="page-title">Input Pegawai Baru</h2>

    {{-- Error --}}
    @if ($errors->any())
      <div class="alert-danger-custom mb-4">
        <strong>Terjadi kesalahan:</strong>
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('pegawai.store') }}" method="POST" id="formPegawai">
      @csrf

      <div class="form-group">
        <label for="id_pegawai">ID Pegawai</label>
        <input type="text" id="idPegawai" name="idPegawai" value="{{ old('idPegawai') }}" required>
      </div>

      <div class="form-group">
        <label for="nama_pegawai">Nama Pegawai</label>
        <input type="text" id="namaPegawai" name="namaPegawai" value="{{ old('namaPegawai') }}" required>
      </div>

      <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenisKelamin" name="jenisKelamin" required>
          <option value="">-- Pilih --</option>
          <option value="Laki-laki" {{ old('jenisKelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
          <option value="Perempuan" {{ old('jenisKelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>

      <div class="form-group">
        <label for="umur">Umur</label>
        <input type="number" id="umur" name="umur" min="18" value="{{ old('umur') }}" required>
      </div>

      <div class="form-group">
        <label for="email">Email Pegawai</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
      </div>

      <div class="form-group">
        <label for="password">Password Pegawai</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="form-btn-bottom">
        <a href="{{ route('pegawai.index') }}" class="btn-cancel">Kembali</a>
        <button type="submit" class="btn-save">Simpan Pegawai</button>
      </div>
    </form>
  </div>
</div>

{{-- Optional: prevent double submit --}}
@push('scripts')
<script>
  document.getElementById('formPegawai').addEventListener('submit', function(){
    this.querySelector('button[type="submit"]').disabled = true;
  });
</script>
@endpush

@endsection
