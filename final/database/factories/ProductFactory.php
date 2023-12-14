<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nombre' => "Producto{$this->faker->name(30)}",
            'descripcion' => $this->faker->text(30),
            'precio_unitario' => $this->faker->randomFloat(2,1,200),
            'cantidad' => $this->faker->randomDigit(),
            'costo_total' =>  $this->faker->randomFloat(2,1,1000),
        ];
    }
}
