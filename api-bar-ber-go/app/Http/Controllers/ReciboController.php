<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReciboController extends Controller
{
    // GET /api/recibos
    public function index()
    {
        $recibos = Recibo::with(['producto', 'metodoPago', 'usuario'])->get();
        return response()->json($recibos);
    }

    // GET /api/recibos/{id}
    public function show($id)
    {
        $recibo = Recibo::with(['producto', 'metodoPago', 'usuario'])->find($id);

        if (!$recibo) {
            return response()->json(['message' => 'Recibo no encontrado'], 404);
        }

        return response()->json($recibo);
    }

    // POST /api/recibos
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

        $recibo = Recibo::create($validated);

        return response()->json($recibo, 201);
    }

    // PUT /api/recibos/{id}
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

        $recibo->update($validated);

        return response()->json($recibo);
    }

    // DELETE /api/recibos/{id}
    public function destroy($id)
    {
        $recibo = Recibo::find($id);

        if (!$recibo) {
            return response()->json(['message' => 'Recibo no encontrado'], 404);
        }

        $recibo->delete();

        return response()->json(['message' => 'Recibo eliminado correctamente']);
    }

    // GET /api/recibos/estadisticas
    public function estadisticas()
    {
        $estadisticas = [
            'total_recibos' => Recibo::count(),
            'monto_total' => Recibo::sum('Total'),
            'monto_promedio' => Recibo::average('Total'),
            'monto_maximo' => Recibo::max('Total'),
            'monto_minimo' => Recibo::min('Total'),
        ];

        return response()->json($estadisticas);
    }

    // GET /api/recibos/pdf
    public function generarPDF()
    {
        $estadisticas = [
            'total_recibos' => Recibo::count(),
            'monto_total' => Recibo::sum('Total'),
            'monto_promedio' => Recibo::average('Total'),
            'monto_maximo' => Recibo::max('Total'),
            'monto_minimo' => Recibo::min('Total'),
        ];

        $pdf = Pdf::loadView('pdf.recibos', compact('estadisticas'));
        return $pdf->download('reporte_estadisticas_recibos.pdf');
    }
}
