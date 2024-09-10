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
        DB::table('suppliers')->insert([
            [
                'name' => 'PT. Bumi Konstruksi',
                'code' => 'SUPP001',
                'contact' => '081234567890',
            ],
            [
                'name' => 'CV. Mitra Abadi',
                'code' => 'SUPP002',
                'contact' => '081987654321',
            ],
            [
                'name' => 'PT. Sumber Alam',
                'code' => 'SUPP003',
                'contact' => '081223344556',
            ],
            [
                'name' => 'UD. Sejahtera Bersama',
                'code' => 'SUPP004',
                'contact' => '081998877665',
            ],
            [
                'name' => 'CV. Putra Mandiri',
                'code' => 'SUPP005',
                'contact' => '081234876543',
            ],
        ]);
    }
}
