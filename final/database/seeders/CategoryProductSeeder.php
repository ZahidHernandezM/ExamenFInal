<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asignar categorías aleatorias a productos aleatorios
        Product::factory(10)->create()->each(function ($product) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $product->categories()->attach($categories);
        });
    }
}
