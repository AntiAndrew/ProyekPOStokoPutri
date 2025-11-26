@extends('layouts.app')

@section('title', 'Daftar Pegawai')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
body { background-color:#e6f7ff; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
.screen-area { width:100%; max-width:1100px; background-color:#f0fff0; padding:25px 40px; box-shadow:0 4px 20px rgba(0,0,0,0.1); margin:30px auto; border-radius:12px; }
.header { display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; border-bottom:2px solid #b3e0b3; padding-bottom:15px; }
.header-title { font-size:28px; font-weight:700; color:#2e8b57; flex-grow:1; text-align:center; }
.header-icons a { font-size:20px; color:#555; margin-right:10px; text-decoration:none; border:1px solid #ccc; padding:8px 12px; border-radius:6px; transition:background-color 0.2s; }
.header-icons a:hover { background-color:#e0e0e0; }
.my-account i { color:#2e8b57; font-size:2.5rem; }

.detail-table { width:100%; border-collapse:collapse; margin-top:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
.detail-table th, .detail-table td { border:1px solid #e0e0e0; padding:12px 10px; }
.detail-table th { background-color:#d4edda; color:#155724; font-weight:700; }
.detail-table td { background-color:#fff; }

.text-center { text-align:center; }
.text-end { text-align:right; }

.action-buttons { display:flex; justify-content:center; gap:10px; flex-wrap:wrap; }
.btn { padding:8px 20px; border:none; border-radius:5px; cursor:pointer; font-weight:bold; transition:background-color 0.3s, transform 0.1s; }
.btn:active { transform:scale(0.98); }
.btn-edit { background-color:#ff9800; color:white; }
.btn-delete { background-color:#f44336; color:white; }
.btn-view { background-color:#4caf50; color:white; }
.btn-add { background-color:#2e8b57; color:white; margin-bottom:15px; display:inline-block; }

@media (max-width:800px) {
    .screen-area { padding:15px 20px; margin:10px; }
    .header-title { font-size:20px; }
    .detail-table th, .detail-table td { padding:8px 5px; font-size:12px; }
    .action-buttons { flex-direction:column; gap:8px; align-items:stretch; }
}
</style>


<div class="screen-area">

    <div class="header">
        <div class="header-icons">
            <a href="{{ url('/') }}" title="Home"><i class="fas fa-home"></i></a>
        </div>
        <div class="header-title">Daftar Pegawai</div>
        <a href="#" class="my-account"><i class="fas fa-user-circle"></i></a>
    </div>

    <a href="{{ route('pegawai.create') }}" class="btn btn-add">
        <i class="fas fa-plus"></i> Tambah Pegawai
    </a>

    <div class="table-responsive">
        <table class="detail-table">
            <thead>
                <tr>
                    <th>ID Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pegawai as $pgw)
                <tr>
                    <td>{{ $pgw->id_pegawai }}</td>
                    <td>{{ $pgw->nama_pegawai }}</td>
                    <td>{{ $pgw->jenis_kelamin }}</td>
                    <td>{{ $pgw->umur }}</td>

                    <td class="text-center">
                        <div class="action-buttons">
                            <a href="{{ route('pegawai.show', $pgw->id_pegawai) }}" class="btn btn-view">
                                <i class="fas fa-eye"></i>
                            </a>

                            <a href="{{ route('pegawai.edit', $pgw->id_pegawai) }}" class="btn btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('pegawai.destroy', $pgw->id_pegawai) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Hapus pegawai {{ $pgw->nama_pegawai }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada pegawai</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection
