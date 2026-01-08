<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('m_user')->pluck('user_id');
        $pembeli = ['Danu', 'Masyhuri', 'Kusuma', 'Dido', 'Ferdi', 'Dinda', 'Imel', 'Hana'];

        for ($i = 1; $i <= 100; $i++) {
            // Ambil barang secara acak yang stoknya masih > 5 (biar aman)
            $barangs = DB::table('m_barang')->where('stok', '>', 5)->get();

            if ($barangs->isEmpty()) break; // Berhenti jika semua barang habis stoknya

            $tanggal = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23));

            // 1. Insert Header Penjualan
            $penjualan_id = DB::table('t_penjualan')->insertGetId([
                'user_id' => $users->random(),
                'pembeli' => $pembeli[array_rand($pembeli)],
                'penjualan_kode' => 'PJN' . $tanggal->format('YmdHis') . $i,
                'penjualan_tanggal' => $tanggal,
                'created_at' => $tanggal,
                'updated_at' => $tanggal,
            ]);

            // 2. Tentukan berapa jenis barang yang dibeli (1-3 jenis)
            $jumlahJenis = rand(1, 3);
            $itemTerpilih = $barangs->random(min($jumlahJenis, $barangs->count()));

            foreach ($itemTerpilih as $barang) {
                $qty = rand(1, 5); // Beli 1-5 unit

                // Cek lagi stoknya sebelum potong (double check)
                if ($barang->stok >= $qty) {
                    DB::table('t_penjualan_detail')->insert([
                        'penjualan_id' => $penjualan_id,
                        'barang_id' => $barang->barang_id,
                        'harga' => $barang->harga_jual,
                        'jumlah' => $qty,
                    ]);

                    // Kurangi stok di m_barang secara real-time saat seeding
                    DB::table('m_barang')->where('barang_id', $barang->barang_id)->decrement('stok', $qty);
                }
            }
        }
    }
}
