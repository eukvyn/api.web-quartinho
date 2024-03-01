<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $defaultProfileImagePath = 'profile_images/default.png';

        DB::table('users')->insert([
            [
                'name' => 'João Silva',
                'email' => 'joao.silva@example.com',
                'password' => Hash::make('password123'),
                'profile_image' => $defaultProfileImagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedro Santos',
                'email' => 'pedro.santos@example.com',
                'password' => Hash::make('password123'),
                'profile_image' => $defaultProfileImagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maria Oliveira',
                'email' => 'maria.oliveira@example.com',
                'password' => Hash::make('password123'),
                'profile_image' => $defaultProfileImagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
