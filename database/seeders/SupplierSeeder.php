<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['supplier_id' => 1, 'supplier_kode' => 'S001', 'supplier_nama' => 'PT. ABC Sukses Selalu', 'supplier_alamat' => 'Jl. Ikan Piranha No. 1'],
            ['supplier_id' => 2, 'supplier_kode' => 'S002', 'supplier_nama' => 'CV. Jalan Barokah', 'supplier_alamat' => 'Jl. Teluk Pacitan No. 5'],
            ['supplier_id' => 3, 'supplier_kode' => 'S003', 'supplier_nama' => 'Distributor Makanan Maju', 'supplier_alamat' => 'Komp. Ruko Baru Blok A'],
        ];

        DB::table('m_supplier')->insert($data);
    }
}
