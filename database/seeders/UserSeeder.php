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
        // Manager A
        User::create([
            'name' => 'Manager A',
            'email' => 'manager_a@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager_a',
        ]);

        // Manager B
        User::create([
            'name' => 'Manager B',
            'email' => 'manager_b@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager_b',
        ]);

        // Staff
        User::create([
            'name' => 'Staff Pembelian',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);
    }
}
