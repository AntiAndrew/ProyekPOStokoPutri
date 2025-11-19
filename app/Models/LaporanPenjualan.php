<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penjualan';

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'metode_pembayaran',
        'jumlah',
        'satuan',
        'harga_barang',
        'total_pembayaran',
        'hpp',
        'keuntungan',
        'tanggal_transaksi',
        'id_transaksi'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'harga_barang' => 'decimal:2',
        'total_pembayaran' => 'decimal:2',
        'hpp' => 'decimal:2',
        'keuntungan' => 'decimal:2',
        'jumlah' => 'integer'
    ];

    // Relasi dengan model Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    // Relasi dengan model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id');
    }

    // Scope untuk filter berdasarkan rentang waktu
    public function scopeFilterByDate($query, $filter)
    {
        switch ($filter) {
            case 'hari_ini':
                return $query->whereDate('tanggal_transaksi', today());
            case '7_hari':
                return $query->where('tanggal_transaksi', '>=', now()->subDays(7));
            case 'bulan':
                return $query->whereMonth('tanggal_transaksi', request('bulan'))
                           ->whereYear('tanggal_transaksi', request('tahun'));
            case 'tanggal':
                return $query->whereDate('tanggal_transaksi', request('tanggal'));
            default:
                return $query;
        }
    }

    // Method untuk menghitung total keuntungan dalam rentang waktu tertentu
    public static function getTotalKeuntungan($filter = null)
    {
        $query = self::query();
        if ($filter) {
            $query->filterByDate($filter);
        }
        return $query->sum('keuntungan');
    }

    // Method untuk mendapatkan laporan penjualan dengan detail
    public static function getLaporanDetail($filter = null)
    {
        $query = self::with(['barang', 'transaksi.user']);

        if ($filter) {
            $query->filterByDate($filter);
        }

        return $query->orderBy('tanggal_transaksi', 'desc')->get();
    }
}
