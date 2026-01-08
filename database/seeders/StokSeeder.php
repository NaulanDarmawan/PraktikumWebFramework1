<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = DB::table('m_barang')->get();
        $suppliers = DB::table('m_supplier')->pluck('supplier_id');
        $users = DB::table('m_user')->pluck('user_id');

        foreach ($barangs as $barang) {
            // Kita beri setiap barang stok masuk antara 50 - 100 unit
            $jumlah = rand(50, 100);

            DB::table('t_stok')->insert([
                'supplier_id' => $suppliers->random(),
                'barang_id' => $barang->barang_id,
                'user_id' => $users->random(),
                'stok_tanggal' => Carbon::now()->subDays(31), // Set sebulan lalu sebagai stok awal
                'stok_jumlah' => $jumlah,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update field stok di m_barang agar sinkron di awal
            DB::table('m_barang')->where('barang_id', $barang->barang_id)->update(['stok' => $jumlah]);
        }
    }
}
