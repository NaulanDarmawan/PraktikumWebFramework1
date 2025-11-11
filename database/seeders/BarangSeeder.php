<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // --- SUPPLIER 1 (S001) - 5 Barang ---
            // Kategori 1 (MKN)
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'B001', 'barang_nama' => 'Roti Tawar Gandum', 'harga_beli' => 12000, 'harga_jual' => 15000],
            // Kategori 2 (MNM)
            ['barang_id' => 2, 'kategori_id' => 2, 'barang_kode' => 'B002', 'barang_nama' => 'Jus Buah Kotak 250ml', 'harga_beli' => 4500, 'harga_jual' => 6000],
            // Kategori 3 (RTG)
            ['barang_id' => 3, 'kategori_id' => 3, 'barang_kode' => 'B003', 'barang_nama' => 'Sabun Cuci Piring', 'harga_beli' => 18000, 'harga_jual' => 24000],
            // Kategori 4 (ATK)
            ['barang_id' => 4, 'kategori_id' => 4, 'barang_kode' => 'B004', 'barang_nama' => 'Buku Tulis Tebal', 'harga_beli' => 11000, 'harga_jual' => 14000],
            // Kategori 5 (ELK)
            ['barang_id' => 5, 'kategori_id' => 5, 'barang_kode' => 'B005', 'barang_nama' => 'Baterai AA Alkaline', 'harga_beli' => 14000, 'harga_jual' => 20000],

            // --- SUPPLIER 2 (S002) - 5 Barang ---
            // Kategori 1 (MKN)
            ['barang_id' => 6, 'kategori_id' => 1, 'barang_kode' => 'B006', 'barang_nama' => 'Keripik Kentang 150g', 'harga_beli' => 10000, 'harga_jual' => 13500],
            // Kategori 2 (MNM)
            ['barang_id' => 7, 'kategori_id' => 2, 'barang_kode' => 'B007', 'barang_nama' => 'Minuman Energi Kaleng', 'harga_beli' => 5500, 'harga_jual' => 7000],
            // Kategori 3 (RTG)
            ['barang_id' => 8, 'kategori_id' => 3, 'barang_kode' => 'B008', 'barang_nama' => 'Sikat Gigi Dewasa', 'harga_beli' => 6000, 'harga_jual' => 8500],
            // Kategori 4 (ATK)
            ['barang_id' => 9, 'kategori_id' => 4, 'barang_kode' => 'B009', 'barang_nama' => 'Pensil HB Set 12', 'harga_beli' => 7000, 'harga_jual' => 10000],
            // Kategori 5 (ELK)
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'B010', 'barang_nama' => 'Kabel Data Type C', 'harga_beli' => 25000, 'harga_jual' => 35000],

            // --- SUPPLIER 3 (S003) - 5 Barang ---
            // Kategori 1 (MKN)
            ['barang_id' => 11, 'kategori_id' => 1, 'barang_kode' => 'B011', 'barang_nama' => 'Mie Instan Rasa Kari', 'harga_beli' => 2000, 'harga_jual' => 3000],
            // Kategori 2 (MNM)
            ['barang_id' => 12, 'kategori_id' => 2, 'barang_kode' => 'B012', 'barang_nama' => 'Air Mineral 600ml', 'harga_beli' => 2000, 'harga_jual' => 3500],
            // Kategori 3 (RTG)
            ['barang_id' => 13, 'kategori_id' => 3, 'barang_kode' => 'B013', 'barang_nama' => 'Pewangi Pakaian', 'harga_beli' => 10000, 'harga_jual' => 15000],
            // Kategori 4 (ATK)
            ['barang_id' => 14, 'kategori_id' => 4, 'barang_kode' => 'B014', 'barang_nama' => 'Spidol Warna Set', 'harga_beli' => 30000, 'harga_jual' => 45000],
            // Kategori 5 (ELK)
            ['barang_id' => 15, 'kategori_id' => 5, 'barang_kode' => 'B015', 'barang_nama' => 'Headset Bluetooth', 'harga_beli' => 75000, 'harga_jual' => 120000],
        ];

        DB::table('m_barang')->insert($data);
    }
}
