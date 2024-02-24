<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'User One',
                'email' => 'userone@example.com',
                'password' => Hash::make('password123'),
                'profile_image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Two',
                'email' => 'usertwo@example.com',
                'password' => Hash::make('password123'),
                'profile_image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Three',
                'email' => 'userthree@example.com',
                'password' => Hash::make('password123'),
                'profile_image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
