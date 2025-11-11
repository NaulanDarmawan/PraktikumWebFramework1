<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $data = [
            // Barang 1-5 disuplai oleh Supplier 1 (ID 1), Stok oleh User 1 (Admin)
            ['stok_id' => 1, 'supplier_id' => 1, 'barang_id' => 1, 'user_id' => 1, 'stok_tanggal' => $now, 'stok_jumlah' => 100],
            ['stok_id' => 2, 'supplier_id' => 1, 'barang_id' => 2, 'user_id' => 1, 'stok_tanggal' => $now, 'stok_jumlah' => 150],
            ['stok_id' => 3, 'supplier_id' => 1, 'barang_id' => 3, 'user_id' => 1, 'stok_tanggal' => $now, 'stok_jumlah' => 80],
            ['stok_id' => 4, 'supplier_id' => 1, 'barang_id' => 4, 'user_id' => 1, 'stok_tanggal' => $now, 'stok_jumlah' => 50],
            ['stok_id' => 5, 'supplier_id' => 1, 'barang_id' => 5, 'user_id' => 1, 'stok_tanggal' => $now, 'stok_jumlah' => 75],

            // Barang 6-10 disuplai oleh Supplier 2 (ID 2), Stok oleh User 2 (Manager)
            ['stok_id' => 6, 'supplier_id' => 2, 'barang_id' => 6, 'user_id' => 2, 'stok_tanggal' => $now->copy()->subDays(1), 'stok_jumlah' => 200],
            ['stok_id' => 7, 'supplier_id' => 2, 'barang_id' => 7, 'user_id' => 2, 'stok_tanggal' => $now->copy()->subDays(1), 'stok_jumlah' => 120],
            ['stok_id' => 8, 'supplier_id' => 2, 'barang_id' => 8, 'user_id' => 2, 'stok_tanggal' => $now->copy()->subDays(1), 'stok_jumlah' => 300],
            ['stok_id' => 9, 'supplier_id' => 2, 'barang_id' => 9, 'user_id' => 2, 'stok_tanggal' => $now->copy()->subDays(1), 'stok_jumlah' => 40],
            ['stok_id' => 10, 'supplier_id' => 2, 'barang_id' => 10, 'user_id' => 2, 'stok_tanggal' => $now->copy()->subDays(1), 'stok_jumlah' => 25],

            // Barang 11-15 disuplai oleh Supplier 3 (ID 3), Stok oleh User 3 (Staff/Kasir)
            ['stok_id' => 11, 'supplier_id' => 3, 'barang_id' => 11, 'user_id' => 3, 'stok_tanggal' => $now->copy()->subDays(2), 'stok_jumlah' => 90],
            ['stok_id' => 12, 'supplier_id' => 3, 'barang_id' => 12, 'user_id' => 3, 'stok_tanggal' => $now->copy()->subDays(2), 'stok_jumlah' => 110],
            ['stok_id' => 13, 'supplier_id' => 3, 'barang_id' => 13, 'user_id' => 3, 'stok_tanggal' => $now->copy()->subDays(2), 'stok_jumlah' => 60],
            ['stok_id' => 14, 'supplier_id' => 3, 'barang_id' => 14, 'user_id' => 3, 'stok_tanggal' => $now->copy()->subDays(2), 'stok_jumlah' => 45],
            ['stok_id' => 15, 'supplier_id' => 3, 'barang_id' => 15, 'user_id' => 3, 'stok_tanggal' => $now->copy()->subDays(2), 'stok_jumlah' => 55],
        ];

        DB::table('t_stok')->insert($data);
    }
}
