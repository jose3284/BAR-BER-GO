<?php

namespace App\Services\Reportes;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Reportes\EstadisticasService;

class ReciboPDFService
{
    protected EstadisticasService $estadisticasService;

    public function __construct(EstadisticasService $estadisticasService)
    {
        $this->estadisticasService = $estadisticasService;
    }

    public function generarPDF()
    {
        $estadisticas = $this->estadisticasService->obtenerEstadisticas();
        return Pdf::loadView('pdf.recibos', compact('estadisticas'));
    }
}
