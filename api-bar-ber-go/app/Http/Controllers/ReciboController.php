<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReciboService;
use App\Services\Reportes\EstadisticasService;
use App\Services\Reportes\ReciboPDFService;
use App\Models\Recibo;

class ReciboController extends Controller
{
    public function __construct(
        protected ReciboService $reciboService,
        protected EstadisticasService $estadisticasService,
        protected ReciboPDFService $pdfService
    ) {}

    public function index()
    {
        return response()->json($this->reciboService->obtenerTodos());
    }

    public function show($id)
    {
        $recibo = $this->reciboService->obtenerPorId($id);

        if (!$recibo) {
            return response()->json(['message' => 'Recibo no encontrado'], 404);
        }

        return response()->json($recibo);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Fecha' => 'required|date',
            'Hora' => 'required',
            'Total' => 'required|numeric',
            'Producto_idProducto' => 'required|integer|exists:producto,idProducto',
            'Metodo_pago_idMetodo_pago' => 'required|integer|exists:metodo_pago,idMetodo_pago',
            'Usuarios_idUsuario' => 'required|integer|exists:usuarios,idUsuario',
        ]);

        $recibo = $this->reciboService->crear($validated);

        return response()->json($recibo, 201);
    }

    public function update(Request $request, $id)
    {
        $recibo = Recibo::find($id);

        if (!$recibo) {
            return response()->json(['message' => 'Recibo no encontrado'], 404);
        }

        $validated = $request->validate([
            'Fecha' => 'sometimes|required|date',
            'Hora' => 'sometimes|required',
            'Total' => 'sometimes|required|numeric',
            'Producto_idProducto' => 'sometimes|required|integer|exists:producto,idProducto',
            'Metodo_pago_idMetodo_pago' => 'sometimes|required|integer|exists:metodo_pago,idMetodo_pago',
            'Usuarios_idUsuario' => 'sometimes|required|integer|exists:usuarios,idUsuario',
        ]);

        $reciboActualizado = $this->reciboService->actualizar($recibo, $validated);

        return response()->json($reciboActualizado);
    }

    public function destroy($id)
    {
        $recibo = Recibo::find($id);

        if (!$recibo) {
            return response()->json(['message' => 'Recibo no encontrado'], 404);
        }

        $this->reciboService->eliminar($recibo);

        return response()->json(['message' => 'Recibo eliminado correctamente']);
    }

    public function estadisticas()
    {
        return response()->json($this->estadisticasService->obtenerEstadisticas());
    }

    public function generarPDF()
    {
        $pdf = $this->pdfService->generarPDF();
        return $pdf->download('reporte_estadisticas_recibos.pdf');
    }
}
