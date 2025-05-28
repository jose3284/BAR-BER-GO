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
            'Precio' => $this->faker->randomFloat(2, 1, 100),
            'imagen' => $this->faker->imageUrl(),
            'id_categoria' => 1, // Asegúrate de tener una categoría creada con este ID
        ];
    }
}
