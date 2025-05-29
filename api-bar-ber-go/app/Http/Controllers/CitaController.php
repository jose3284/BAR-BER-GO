<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Cita\Interfaces\CitaServiceInterface;
use App\Services\Reportes\ReportePDFService;

class CitaController extends Controller
{
    protected CitaServiceInterface $citaService;
    protected ReportePDFService $pdfService;

    public function __construct(CitaServiceInterface $citaService, ReportePDFService $pdfService)
    {
        $this->citaService = $citaService;
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        return response()->json($this->citaService->getAll(), 200);
    }

    public function show($id)
    {
        $cita = $this->citaService->find($id);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        return response()->json($cita, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|max:255',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $cita = $this->citaService->create($data);

        return response()->json($cita, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'celular' => 'sometimes|required|string|max:20',
            'correo' => 'sometimes|required|email|max:255',
            'fecha' => 'sometimes|required|date',
            'hora' => 'sometimes|required|date_format:H:i',
        ]);

        $cita = $this->citaService->update($id, $data);

        if (!$cita) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        return response()->json($cita, 200);
    }

    public function destroy($id)
    {
        $deleted = $this->citaService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Cita no encontrada'], 404);
        }

        return response()->json(['message' => 'Cita eliminada con éxito'], 200);
    }

    public function estadisticas()
    {
        return response()->json($this->citaService->getEstadisticas(), 200);
    }

    public function generarPDF()
    {
        $data = $this->citaService->getEstadisticas();
        $data['fecha_generacion'] = now()->format('d/m/Y H:i:s');

        return $this->pdfService->generar('pdf.reporte_citas', $data, 'reporte_citas.pdf');
    }
}
