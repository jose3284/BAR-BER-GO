<?php

namespace App\Services\Reportes;

use Barryvdh\DomPDF\Facade\Pdf;

class ReportePDFService
{
    public function generar(string $vista, array $data, string $nombreArchivo)
    {
        $pdf = Pdf::loadView($vista, $data);
        return $pdf->download($nombreArchivo);
    }
}
