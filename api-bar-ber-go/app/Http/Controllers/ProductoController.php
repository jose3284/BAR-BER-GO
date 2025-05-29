<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Producto\ProductoService;
use App\Services\Reportes\ReportePDFService;

class ProductoController extends Controller
{
    protected ProductoService $productoService;
    protected ReportePDFService $pdfService;

    public function __construct(ProductoService $productoService, ReportePDFService $pdfService)
    {
        $this->productoService = $productoService;
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        return response()->json($this->productoService->obtenerTodos());
    }

    public function show($id)
    {
        $producto = $this->productoService->obtenerPorId($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nombre' => 'required|string|max:255',
            'Cantidad' => 'required|integer',
            'Precio' => 'required|numeric',
            'imagen' => 'nullable|string',
            'id_categoria' => 'required|integer'
        ]);

        $producto = $this->productoService->crear($data);

        return response()->json($producto, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Nombre' => 'sometimes|required|string|max:255',
            'Cantidad' => 'sometimes|required|integer',
            'Precio' => 'sometimes|required|numeric',
            'imagen' => 'nullable|string',
            'id_categoria' => 'sometimes|required|integer'
        ]);

        $producto = $this->productoService->actualizar($id, $data);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    public function destroy($id)
    {
        $eliminado = $this->productoService->eliminar($id);

        if (!$eliminado) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }

    public function estadisticas()
    {
        return response()->json($this->productoService->obtenerEstadisticas());
    }

    public function generarPDF()
    {
        $data = $this->productoService->obtenerDatosPDF();
        return $this->pdfService->generar('pdf.reporte_productos', $data, 'reporte_productos.pdf');
    }
}
