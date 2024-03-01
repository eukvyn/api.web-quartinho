<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitiesTableSeeder extends Seeder
{
    public function run()
    {
        $amenities = [
            ['name' => 'Wi-Fi'],
            ['name' => 'Piscina'],
            ['name' => 'Academia'],
            ['name' => 'Ar-condicionado'],
            ['name' => 'Estacionamento'],
            ['name' => 'Segurança 24h'],
            ['name' => 'Área de serviço'],
            ['name' => 'Pet Friendly'],
            ['name' => 'Mobiliado'],
        ];

        DB::table('amenities')->insert($amenities);
    }
}
