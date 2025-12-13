<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penjualan';

    protected $fillable = [
        'id_laporan',
        'tanggal_transaksi',
        'rentang_waktu',
        'total_penjualan',
        'kerugian',
        'keuntungan'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'total_penjualan' => 'decimal:2',
        'kerugian' => 'decimal:2',
        'keuntungan' => 'decimal:2'
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
                if (request('bulan_tahun')) {
                    $date = \Carbon\Carbon::createFromFormat('Y-m', request('bulan_tahun'));
                    return $query->whereMonth('tanggal_transaksi', $date->month)
                               ->whereYear('tanggal_transaksi', $date->year);
                }
                return $query;
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
