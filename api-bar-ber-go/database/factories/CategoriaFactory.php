<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = \App\Models\Categoria::class;

    public function definition(): array
    {
        return [
            'categoria' => $this->faker->word,
        ];
    }
}
