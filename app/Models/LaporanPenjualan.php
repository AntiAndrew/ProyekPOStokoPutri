<?php

<<<<<<< HEAD
class LaporanPenjualan
{
    private $conn;
    private $table = "penjualan";

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "db_salon");

        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }

    public function getData($filterData = [])
    {
        $query = "SELECT * FROM $this->table";
        $filterText = "";

        if (!empty($filterData['rentang'])) {
            $rentang = $filterData['rentang'];

            switch ($rentang) {
                case "hari_ini":
                    $query .= " WHERE DATE(tanggal) = CURDATE()";
                    $filterText = "Hari Ini";
                    break;

                case "7_hari":
                    $query .= " WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                    $filterText = "7 Hari Terakhir";
                    break;

                case "bulan":
                    $bulan = $filterData['bulan'];
                    $tahun = $filterData['tahun'];
                    $query .= " WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
                    $filterText = "Periode: $bulan-$tahun";
                    break;

                case "tanggal":
                    $tgl = $filterData['tanggal'];
                    $query .= " WHERE tanggal = '$tgl'";
                    $filterText = "Tanggal: $tgl";
                    break;
            }
        }

        $query .= " ORDER BY tanggal DESC";

        $run = $this->conn->query($query);
        $rows = [];

        while ($row = $run->fetch_assoc()) {
            $rows[] = $row;
        }

        return [
            "keterangan_filter" => $filterText,
            "data" => $rows
        ];
=======
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
>>>>>>> ce39ef79466edf2991defd5a89d2fdc72c3c276f
    }
}
