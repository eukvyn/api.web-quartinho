<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Amenity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertiesTableSeeder extends Seeder
{
    public function run()
    {
        $propertiesData = [
            [
                'title' => 'Apartamento Aconchegante',
                'description' => 'Um lindo apartamento no centro da cidade, perfeito para famílias.',
                'rental_price' => 2000.00,
                'address' => 'Rua das Flores, 123, Centro',
                'user_id' => 1,
            ],
            [
                'title' => 'Casa Espaçosa com Jardim',
                'description' => 'Espaçosa casa com um belo jardim e área de lazer.',
                'rental_price' => 3000.00,
                'address' => 'Avenida dos Jardins, 456, Bairro Jardim',
                'user_id' => 2,
            ],
            [
                'title' => 'Cobertura com Vista para o Mar',
                'description' => 'Incrível cobertura com vista panorâmica para o mar, ideal para quem busca luxo e conforto.',
                'rental_price' => 5000.00,
                'address' => 'Rua Oceânica, 789, Praia Bela',
                'user_id' => 3,
            ],
        ];

        foreach ($propertiesData as $data) {
            $property = Property::create($data);

            $amenitiesIds = Amenity::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $property->amenities()->sync($amenitiesIds);

            $property->images()->create(['image_path' => 'property_images/default.jpg']);
        }
    }
}
