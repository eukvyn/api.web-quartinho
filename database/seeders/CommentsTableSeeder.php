<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $comments = [];

        $numUsers = 3;
        $numProperties = 3;

        $texts = [
            'Ótimo lugar, realmente gostei da minha estadia!',
            'Apartamento adorável, muito limpo e bem localizado.',
            'Incrível experiência, com certeza voltaria!',
        ];

        $ratings = [5, 4, 5];

        for ($propertyId = 1; $propertyId <= $numProperties; $propertyId++) {
            for ($userId = 1; $userId <= $numUsers; $userId++) {
                $comments[] = [
                    'text' => $texts[array_rand($texts)],
                    'rating' => $ratings[array_rand($ratings)],
                    'user_id' => $userId,
                    'property_id' => $propertyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('comments')->insert($comments);
    }
}
