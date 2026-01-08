<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) ['title' => 'Transaksi Penjualan', 'list' => ['Home', 'Penjualan']];
        $page = (object) ['title' => 'Daftar transaksi penjualan'];
        $activeMenu = 'penjualan';
        return view('penjualan.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::with('user')->select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal');
        return DataTables::of($penjualans)
            ->addIndexColumn()
            ->addColumn('action', function ($p) {
                return '<button onclick="modalAction(\'' . url('/penjualan/' . $p->penjualan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create_ajax()
    {
        $user = UserModel::all();
        $barang = BarangModel::where('stok', '>', 0)->get();
        return view('penjualan.create_ajax', compact('user', 'barang'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'user_id' => 'required|integer',
                'pembeli' => 'required|string|max:100',
                'penjualan_kode' => 'required|unique:t_penjualan,penjualan_kode',
                'penjualan_tanggal' => 'required|date',
                'barang_id' => 'required|array', // Harus array karena multi-item
                'jumlah' => 'required|array'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            DB::beginTransaction();
            try {
                // 1. Simpan Header
                $penjualan = PenjualanModel::create([
                    'user_id' => $request->user_id,
                    'pembeli' => $request->pembeli,
                    'penjualan_kode' => $request->penjualan_kode,
                    'penjualan_tanggal' => $request->penjualan_tanggal
                ]);

                // 2. Simpan Detail & Kurangi Stok
                foreach ($request->barang_id as $key => $id) {
                    $barang = BarangModel::find($id);
                    $qty = $request->jumlah[$key];

                    // Cek stok cukup gak?
                    if ($barang->stok < $qty) {
                        throw new \Exception("Stok barang " . $barang->barang_nama . " tidak mencukupi");
                    }

                    PenjualanDetailModel::create([
                        'penjualan_id' => $penjualan->penjualan_id,
                        'barang_id' => $id,
                        'harga' => $barang->harga_jual,
                        'jumlah' => $qty
                    ]);

                    $barang->stok -= $qty;
                    $barang->save();
                }

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Transaksi Berhasil']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            }
        }
    }

    public function show_ajax($id)
    {
        $penjualan = PenjualanModel::with(['user', 'details.barang'])->find($id);
        return view('penjualan.show_ajax', compact('penjualan'));
    }
}
