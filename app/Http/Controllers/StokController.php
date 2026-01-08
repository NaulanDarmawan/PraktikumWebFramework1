<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\SupplierModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) ['title' => 'Daftar Stok', 'list' => ['Home', 'Stok']];
        $page = (object) ['title' => 'Daftar stok barang masuk'];
        $activeMenu = 'stok';
        return view('stok.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $stoks = StokModel::with(['barang', 'user', 'supplier'])->select('stok_id', 'supplier_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah');
        return DataTables::of($stoks)
            ->addIndexColumn()
            ->make(true);
    }

    public function create_ajax()
    {
        $supplier = SupplierModel::all();
        $barang = BarangModel::all();
        $user = UserModel::all();
        return view('stok.create_ajax', compact('supplier', 'barang', 'user'));
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_id' => 'required|integer',
                'barang_id'   => 'required|integer',
                'user_id'     => 'required|integer',
                'stok_jumlah' => 'required|integer|min:1',
                'stok_tanggal' => 'required|date'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Validasi Gagal', 'msgField' => $validator->errors()]);
            }

            DB::beginTransaction();
            try {
                $data = $request->all();
                $data['stok_tanggal'] = date('Y-m-d H:i:s', strtotime($request->stok_tanggal));
                StokModel::create($data);

                // LOGIC: Tambah stok di tabel m_barang
                $barang = BarangModel::find($request->barang_id);
                $barang->stok += $request->stok_jumlah;
                $barang->save();

                DB::commit();
                return response()->json(['status' => true, 'message' => 'Data stok berhasil disimpan']);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['status' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }
        return redirect('/');
    }
}
