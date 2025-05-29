<?php

namespace Database\Factories;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition()
    {
        return [
            'Nombre' => $this->faker->firstName,
            'P_apellido' => $this->faker->lastName,
            'S_apellido' => $this->faker->lastName,
            'Correo' => $this->faker->unique()->safeEmail,
            'Pass' => Hash::make('password'), // o bcrypt('password')
            'id_roles' => Rol::factory(), // Asegúrate de tener RolFactory
            'userState' => true,
        ];
    }
}
