<?php

namespace Database\Factories;

use App\Models\Recibo;
use App\Models\Producto;
use App\Models\MetodoPago;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReciboFactory extends Factory
{
    protected $model = Recibo::class;

    public function definition(): array
    {
        return [
            'Fecha' => $this->faker->date(),
            'Hora' => $this->faker->time(),
            'Total' => $this->faker->randomFloat(2, 10, 500),
            'Producto_idProducto' => Producto::factory(),
            'Metodo_pago_idMetodo_pago' => MetodoPago::factory(),
            'Usuarios_idUsuario' => Usuario::factory(),
        ];
    }
}
