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
     */
    public function run(): void
    {
        User::create([
            'name' => 'Manager A',
            'email' => 'manager.a@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager_a'
        ]);

        // Tambahkan data untuk Manager B
        User::create([
            'name' => 'Manager B',
            'email' => 'manager.b@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager_b'
        ]);

        // Tambahkan data untuk Staff Pembelian
        User::create([
            'name' => 'Staff Pembelian',
            'email' => 'staff.purchase@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff_purchase'
        ]);

        // Tambahkan data untuk Staff Gudang
        User::create([
            'name' => 'Staff Gudang',
            'email' => 'staff.warehouse@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff_warehouse'
        ]);
    }
}
