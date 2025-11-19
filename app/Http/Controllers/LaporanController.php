<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\LaporanPenjualan;
use App\Models\LaporanTransaksi;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('rentang', null);
        $data = LaporanPenjualan::getLaporanDetail($filter);

        // Jika tidak ada data dari model, gunakan data statis sebagai fallback
        if ($data->isEmpty()) {
            $data = collect([
                ["BRG001", "Shampoo Lavender", "Cash", 3, "Botol", 35000, 105000, 70000, 35000],
                ["BRG002", "Hair Dryer Mini", "Transfer", 1, "Unit", 150000, 150000, 120000, 30000],
            ]);
        }

        return view('laporan.penjualan', compact('data', 'filter'));
    }

    public function transaksi(Request $request)
    {
        $filter = $request->get('rentang', null);
        $data = LaporanTransaksi::getLaporanLengkap($filter);

        // Jika tidak ada data dari model, gunakan data kosong sebagai fallback
        if ($data->isEmpty()) {
            $data = collect();
        }

        return view('laporan.transaksi', compact('data', 'filter'));
    }
}
