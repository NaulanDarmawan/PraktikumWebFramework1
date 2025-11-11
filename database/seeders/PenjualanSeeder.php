<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Atur tanggal awal 5 hari yang lalu untuk variasi
        $date = $now->copy()->subDays(5);

        $data = [
            ['penjualan_id' => 1, 'user_id' => 3, 'pembeli' => 'Agung', 'penjualan_kode' => 'PJL001', 'penjualan_tanggal' => $date->copy()->addDays(4)],
            ['penjualan_id' => 2, 'user_id' => 3, 'pembeli' => 'Naulan', 'penjualan_kode' => 'PJL002', 'penjualan_tanggal' => $date->copy()->addDays(4)],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Darmawan', 'penjualan_kode' => 'PJL003', 'penjualan_tanggal' => $date->copy()->addDays(3)],
            ['penjualan_id' => 4, 'user_id' => 3, 'pembeli' => 'Wahyu', 'penjualan_kode' => 'PJL004', 'penjualan_tanggal' => $date->copy()->addDays(3)],
            ['penjualan_id' => 5, 'user_id' => 3, 'pembeli' => 'Maftuh', 'penjualan_kode' => 'PJL005', 'penjualan_tanggal' => $date->copy()->addDays(2)],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Bintang', 'penjualan_kode' => 'PJL006', 'penjualan_tanggal' => $date->copy()->addDays(2)],
            ['penjualan_id' => 7, 'user_id' => 3, 'pembeli' => 'Mashuri', 'penjualan_kode' => 'PJL007', 'penjualan_tanggal' => $date->copy()->addDays(1)],
            ['penjualan_id' => 8, 'user_id' => 3, 'pembeli' => 'Kusuma', 'penjualan_kode' => 'PJL008', 'penjualan_tanggal' => $date->copy()->addDays(1)],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Dido', 'penjualan_kode' => 'PJL009', 'penjualan_tanggal' => $date->copy()],
            ['penjualan_id' => 10, 'user_id' => 3, 'pembeli' => 'Ferdi', 'penjualan_kode' => 'PJL010', 'penjualan_tanggal' => $date->copy()],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
