<?php

namespace Database\Factories;

use App\Models\Cita;
use Illuminate\Database\Eloquent\Factories\Factory;

class CitaFactory extends Factory
{
    protected $model = Cita::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'celular' => $this->faker->phoneNumber,
            'correo' => $this->faker->safeEmail,
            'fecha' => $this->faker->date(),
            'hora' => $this->faker->time(),
        ];
    }
}
