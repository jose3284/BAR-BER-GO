<?php

namespace Database\Factories;

use App\Models\MetodoPago;
use Illuminate\Database\Eloquent\Factories\Factory;

class MetodoPagoFactory extends Factory
{
    protected $model = MetodoPago::class;

    public function definition()
    {
        return [
            'Metodo_pago' => $this->faker->randomElement([
                'Efectivo', 'Tarjeta', 'Transferencia', 'Cheque'
            ]),
        ];
    }
}
