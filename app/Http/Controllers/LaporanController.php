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
