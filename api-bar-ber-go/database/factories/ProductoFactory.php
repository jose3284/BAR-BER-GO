<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'Nombre' => $this->faker->word(),
            'Cantidad' => $this->faker->numberBetween(1, 100),
            'Precio' => $this->faker->randomFloat(2, 10, 1000),
            'imagen' => $this->faker->imageUrl(640, 480, 'products'),
            'id_categoria' => \App\Models\Categoria::factory(), // genera categoría relacionada
        ];
    }
}
