<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductoService;
use App\Services\Reportes\ReportePDFService;

class ProductoController extends Controller
{
    protected $productoService;
    protected $pdfService;

    public function __construct(ProductoService $productoService, ReportePDFService $pdfService)
    {
        $this->productoService = $productoService;
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        return response()->json($this->productoService->getAll());
    }

    public function show($id)
    {
        $producto = $this->productoService->find($id);

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

        $producto = $this->productoService->create($data);

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

        $producto = $this->productoService->update($id, $data);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json($producto);
    }

    public function destroy($id)
    {
        $deleted = $this->productoService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        return response()->json(['message' => 'Producto eliminado correctamente']);
    }

    public function estadisticas()
    {
        return response()->json($this->productoService->getEstadisticas());
    }

    public function generarPDF()
    {
        $data = $this->productoService->getPDFData();
        return $this->pdfService->generar('pdf.reporte_productos', $data, 'reporte_productos.pdf');
    }
}
