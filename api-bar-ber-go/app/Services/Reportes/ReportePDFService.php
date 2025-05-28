<?php

namespace App\Services\Reportes;

use Barryvdh\DomPDF\Facade\Pdf;

class ReportePDFService
{
    public function generar(string $view, array $data, string $filename)
    {
        $pdf = Pdf::loadView($view, $data);
        return $pdf->download($filename);
    }
}
