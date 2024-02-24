<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertiesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('properties')->insert([
            [
                'title' => 'Beautiful Apartment',
                'photo' => null,
                'description' => 'A beautiful apartment in the city center.',
                'rental_price' => 1500.00,
                'address' => '123 Main Street, City Center',
                'user_id' => 1,
                'amenities' => json_encode(['Wi-Fi', 'Air Conditioning']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
