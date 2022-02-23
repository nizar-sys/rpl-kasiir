<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaksis = [
            [
                'nama_pelanggan' => 'pelanggan 1',
                'menu_id' => 1,
                'jumlah' => 2,
                'total_harga' => 20000,
                'kasir_id' => 3,
                'created_at' => now(),
            ],
            [
                'nama_pelanggan' => 'pelanggan 2',
                'menu_id' => 2,
                'jumlah' => 2,
                'total_harga' => 20000,
                'kasir_id' => 3,
                'created_at' => now(),
            ],
            [
                'nama_pelanggan' => 'pelanggan 2',
                'menu_id' => 3,
                'jumlah' => 2,
                'total_harga' => 20000,
                'kasir_id' => 3,
                'created_at' => now(),
            ],
        ];
        Transaksi::insert($transaksis);
    }
}
