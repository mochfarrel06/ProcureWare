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
        DB::table('materials')->insert(
            [
                [
                    'name' => 'Baja Ringan',
                    'code' => 'MTRL001',
                    'unit' => 'Batang',
                    'description' => 'Baja ringan yang digunakan untuk rangka atap, kuat dan tahan karat, cocok untuk konstruksi bangunan.'
                ],
                [
                    'name' => 'Semen Portland',
                    'code' => 'MTRL002',
                    'unit' => 'Sak',
                    'description' => 'Semen Portland berkualitas tinggi untuk pekerjaan beton, plesteran, dan pasangan batu bata.'
                ],
                [
                    'name' => 'Pasir Sungai',
                    'code' => 'MTRL003',
                    'unit' => 'M3',
                    'description' => 'Pasir sungai bersih dan halus yang ideal untuk campuran beton dan mortar.'
                ],
                [
                    'name' => 'Besi Beton',
                    'code' => 'MTRL004',
                    'unit' => 'Batang',
                    'description' => 'Besi beton ulir dan polos untuk memperkuat struktur beton bangunan agar lebih kokoh.'
                ],
                [
                    'name' => 'Kayu Balok',
                    'code' => 'MTRL005',
                    'unit' => 'Batang',
                    'description' => 'Kayu balok kuat dan tahan lama, digunakan untuk berbagai kebutuhan konstruksi bangunan.'
                ],
                [
                    'name' => 'Pipa PVC 2 Inch',
                    'code' => 'MTRL006',
                    'unit' => 'Batang',
                    'description' => 'Pipa PVC 2 inch berkualitas untuk saluran air, mudah dipasang dan tahan lama.'
                ],
                [
                    'name' => 'Kabel Listrik 2.5mm',
                    'code' => 'MTRL007',
                    'unit' => 'Roll',
                    'description' => 'Kabel listrik ukuran 2.5mm, cocok untuk instalasi listrik rumah dan gedung.'
                ],
            ]
        );
    }
}
