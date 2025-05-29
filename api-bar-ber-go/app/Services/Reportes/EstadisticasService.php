<?php

namespace App\Services\Reportes;

use App\Models\Recibo;

class EstadisticasService
{
    public function obtenerEstadisticas(): array
    {
        return [
            'total_recibos' => Recibo::count(),
            'monto_total' => Recibo::sum('Total'),
            'monto_promedio' => Recibo::average('Total'),
            'monto_maximo' => Recibo::max('Total'),
            'monto_minimo' => Recibo::min('Total'),
        ];
    }
}
