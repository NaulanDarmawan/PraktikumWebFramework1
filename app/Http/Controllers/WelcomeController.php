<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Home', 'Dashboard']
        ];

        $activeMenu = 'dashboard';

        // 1. Statistik Info Box
        $stats = [
            'total_barang' => BarangModel::count(),
            'total_supplier' => SupplierModel::count(),
            'total_user' => UserModel::count(),
            'total_penjualan' => PenjualanModel::count(),
        ];

        // 2. Hitung Omzet
        $total_pendapatan = DB::table('t_penjualan_detail')
            ->select(DB::raw('SUM(harga * jumlah) as total'))
            ->first()->total ?? 0;

        // 3. Data Chart Penjualan (7 Hari Terakhir)
        $chart_data = DB::table('t_penjualan')
            ->join('t_penjualan_detail', 't_penjualan.penjualan_id', '=', 't_penjualan_detail.penjualan_id')
            ->select(
                DB::raw('DATE(penjualan_tanggal) as tanggal'),
                DB::raw('SUM(harga * jumlah) as total')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->limit(7)
            ->get();

        // 4. Transaksi Terakhir (tetap pakai limit untuk performa)
        $transaksi_terakhir = PenjualanModel::with('user')
            ->orderBy('penjualan_tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('welcome', compact('breadcrumb', 'activeMenu', 'stats', 'total_pendapatan', 'chart_data', 'transaksi_terakhir'));
    }

    // 5. Fungsi khusus untuk list stok hampir habis via AJAX (untuk DataTable)
    public function low_stock_list()
    {
        $barang = BarangModel::where('stok', '<', 10)->select('barang_nama', 'stok');

        return datatables()->of($barang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return '<a href="'.url('/stok').'" class="btn btn-xs btn-primary">Tambah</a>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
