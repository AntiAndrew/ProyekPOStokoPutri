<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTransaksi extends Model
{
    use HasFactory;

    protected $table = 'laporan_transaksi';

    protected $fillable = [
        'id_transaksi',
        'tanggal_transaksi',
        'total_item',
        'total_harga',
        'metode_pembayaran',
        'status_transaksi',
        'id_user',
        'catatan'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'total_harga' => 'decimal:2',
        'total_item' => 'integer'
    ];

    // Relasi dengan model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id');
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi dengan detail transaksi (jika ada tabel pivot)
    public function detailTransaksi()
    {
        return $this->hasMany(TransaksiItem::class, 'id_transaksi', 'id_transaksi');
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

    // Method untuk menghitung total transaksi dalam rentang waktu tertentu
    public static function getTotalTransaksi($filter = null)
    {
        $query = self::query();
        if ($filter) {
            $query->filterByDate($filter);
        }
        return $query->sum('total_harga');
    }

    // Method untuk mendapatkan jumlah transaksi per hari
    public static function getTransaksiPerHari($filter = null)
    {
        $query = self::selectRaw('DATE(tanggal_transaksi) as tanggal, COUNT(*) as jumlah_transaksi, SUM(total_harga) as total_harga')
                    ->groupBy('tanggal')
                    ->orderBy('tanggal', 'desc');

        if ($filter) {
            $query->filterByDate($filter);
        }

        return $query->get();
    }

    // Method untuk mendapatkan laporan transaksi lengkap
    public static function getLaporanLengkap($filter = null)
    {
        $query = self::with(['transaksi', 'user', 'detailTransaksi.barang']);

        if ($filter) {
            $query->filterByDate($filter);
        }

        return $query->orderBy('tanggal_transaksi', 'desc')->get();
    }
}
