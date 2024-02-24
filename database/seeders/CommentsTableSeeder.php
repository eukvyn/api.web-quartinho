<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            [
                'text' => 'Great place, really enjoyed my stay!',
                'rating' => 5,
                'user_id' => 2,
                'property_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'text' => 'Lovely apartment, very clean and well located.',
                'rating' => 4,
                'user_id' => 3,
                'property_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
