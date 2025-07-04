<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electrónicos',
                'description' => 'Dispositivos electrónicos y accesorios'
            ],
            [
                'name' => 'Ropa',
                'description' => 'Prendas de vestir para todas las edades'
            ],
            [
                'name' => 'Hogar',
                'description' => 'Artículos para el hogar y decoración'
            ],
            [
                'name' => 'Jardín',
                'description' => 'Herramientas y plantas para el jardín'
            ],
            [
                'name' => 'Deportes',
                'description' => 'Equipamiento deportivo y ropa deportiva'
            ],
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
