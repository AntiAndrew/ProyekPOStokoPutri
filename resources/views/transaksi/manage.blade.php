@extends('layouts.app')

@section('title', 'Manage Transaksi')

@section('content')
<div class="screen-area">
    <h2>Daftar Transaksi (Mode: {{ $mode }})</h2>

    <table class="detail-table">
        <thead>
            <tr>
                <th>No. Ref</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Salesman</th>
                <th>Total Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $trx)
            <tr>
                <td>{{ $trx->no_transaksi ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d F Y') }}</td>
                <td>{{ $trx->pelanggan ?? 'Umum' }}</td>
                <td>{{ $trx->user->name ?? 'N/A' }}</td>
                <td class="text-end">{{ number_format($trx->total ?? 0,0,',','.') }}</td>
                <td>
                    @if($mode == 'edit')
                        <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn btn-edit">Edit</a>
                    @elseif($mode == 'delete')
                        <form action="{{ route('transaksi.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi {{ $trx->no_transaksi }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
