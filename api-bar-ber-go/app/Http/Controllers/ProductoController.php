<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    // GET /api/productos
    public function ProductoIndex()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    // GET /api/productos/{id}
    public function ProductoShow($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    // POST /api/productos
    public function ProductoStore(Request $request)
    {
        $validated = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Cantidad' => 'required|integer',
            'Precio' => 'required|numeric',
            'imagen' => 'nullable|string',
            'id_categoria' => 'required|integer'
        ]);

        $producto = Producto::create($validated);

        return response()->json($producto, 201);
    }

    // PUT /api/productos/{id}
    public function ProductoUpdate(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validated = $request->validate([
            'Nombre' => 'sometimes|required|string|max:255',
            'Cantidad' => 'sometimes|required|integer',
            'Precio' => 'sometimes|required|numeric',
            'imagen' => 'nullable|string',
            'id_categoria' => 'sometimes|required|integer'
        ]);

        $producto->update($validated);

        return response()->json($producto);
    }

    // DELETE /api/productos/{id}
    public function ProductoDestroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }

    public function estadisticas()
{
    $productos = \App\Models\Producto::all();

    $total = $productos->count();
    $promedioPrecio = $productos->avg('Precio');
    $maxPrecio = $productos->max('Precio');
    $minPrecio = $productos->min('Precio');

    return response()->json([
        'total_productos' => $total,
        'precio_promedio' => $promedioPrecio,
        'precio_maximo' => $maxPrecio,
        'precio_minimo' => $minPrecio,
    ]);
}

public function generarPDF()
{
    $productos = \App\Models\Producto::all();

    $data = [
        'productos' => $productos,
        'total' => $productos->count(),
        'fecha' => now()->toDateTimeString()
    ];

    $pdf = Pdf::loadView('pdf.reporte_productos', $data);

    return $pdf->download('reporte_productos.pdf');
}
}
