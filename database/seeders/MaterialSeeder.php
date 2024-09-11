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
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio repellat qui nobis'
            ],
            [
                'name' => 'Semen Portland',
                'code' => 'MTRL002',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio repellat qui nobis'
            ],
            [
                'name' => 'Pasir Sungai',
                'code' => 'MTRL003',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio repellat qui nobis'
            ],
            [
                'name' => 'Besi Beton',
                'code' => 'MTRL004',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio repellat qui nobis'
            ],
            [
                'name' => 'Kayu Balok',
                'code' => 'MTRL005',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio repellat qui nobis'
            ],
            [
                'name' => 'Pipa PVC 2 Inch',
                'code' => 'MTRL006',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio repellat qui nobis'
            ],
            [
                'name' => 'Kabel Listrik 2.5mm',
                'code' => 'MTRL007',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio repellat qui nobis'
            ],
        ]);
    }
}
