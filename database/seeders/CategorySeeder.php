<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Laptop',
            'Monitor',
            'Impresora',
            'Teclado',
            'Mouse'
        ];

        foreach ($categories as $name) {
            // Evita duplicados si ya existe la categoría
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
