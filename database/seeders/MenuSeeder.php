<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'nama_menu' => 'Nasi Goreng',
                'harga' => 10000,
                'deskripsi' => 'Nasi goreng yang dibuat dengan bahan dasar nasi, telur, serta bumbu-bumbu yang diaduk serta ditambahkan bawang goreng',
                'stok' => 10,
                'created_by' => 2,
                'created_at' => now(),
            ],
            [
                'nama_menu' => 'Nasi Putih',
                'harga' => 10000,
                'deskripsi' => 'Nasi putih yang dibuat dengan bahan dasar nasi, telur, serta bumbu-bumbu yang diaduk serta ditambahkan bawang goreng',
                'stok' => 10,
                'created_by' => 2,
                'created_at' => now(),
            ],
            [
                'nama_menu' => 'Nasi Uduk',
                'harga' => 10000,
                'deskripsi' => 'Nasi uduk yang dibuat dengan bahan dasar nasi, telur, serta bumbu-bumbu yang diaduk serta ditambahkan bawang goreng',
                'stok' => 10,
                'created_by' => 2,
                'created_at' => now(),
            ],
            [
                'nama_menu' => 'Nasi Goreng',
                'harga' => 10000,
                'deskripsi' => 'Nasi goreng yang dibuat dengan bahan dasar nasi, telur, serta bumbu-bumbu yang diaduk serta ditambahkan bawang goreng',
                'stok' => 10,
                'created_by' => 2,
                'created_at' => now(),
            ],
            [
                'nama_menu' => 'Nasi Putih',
                'harga' => 10000,
                'deskripsi' => 'Nasi putih yang dibuat dengan bahan dasar nasi, telur, serta bumbu-bumbu yang diaduk serta ditambahkan bawang goreng',
                'stok' => 10,
                'created_by' => 2,
                'created_at' => now(),
            ],
        ];

        Menu::insert($menus);
    }
}
