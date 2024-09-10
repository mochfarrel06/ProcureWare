<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materials')->insert([
            [
                'name' => 'Baja Ringan',
                'code' => 'MTRL001',
                'category' => 'Konstruksi',
                'stock' => 100,
            ],
            [
                'name' => 'Semen Portland',
                'code' => 'MTRL002',
                'category' => 'Konstruksi',
                'stock' => 250,
            ],
            [
                'name' => 'Pasir Sungai',
                'code' => 'MTRL003',
                'category' => 'Konstruksi',
                'stock' => 500,
            ],
            [
                'name' => 'Besi Beton',
                'code' => 'MTRL004',
                'category' => 'Konstruksi',
                'stock' => 150,
            ],
            [
                'name' => 'Kayu Balok',
                'code' => 'MTRL005',
                'category' => 'Konstruksi',
                'stock' => 75,
            ],
            [
                'name' => 'Pipa PVC 2 Inch',
                'code' => 'MTRL006',
                'category' => 'Pipa & Plumbing',
                'stock' => 200,
            ],
            [
                'name' => 'Kabel Listrik 2.5mm',
                'code' => 'MTRL007',
                'category' => 'Listrik',
                'stock' => 300,
            ],
        ]);
    }
}
