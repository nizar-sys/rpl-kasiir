<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'created_at' => now(),
            ],
            [
                'username' => 'manager',
                'password' => Hash::make('manager'),
                'role' => 'manager',
                'created_at' => now(),
            ],
            [
                'username' => 'kasir',
                'password' => Hash::make('kasir'),
                'role' => 'kasir',
                'created_at' => now(),
            ],
            
        ];
        User::insert($users);
    }
}
