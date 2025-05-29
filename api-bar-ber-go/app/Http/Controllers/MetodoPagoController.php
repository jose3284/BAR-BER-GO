<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MetodoPago\MetodoPagoService;

class MetodoPagoController extends Controller
{
    protected MetodoPagoService $metodoPagoService;

    public function __construct(MetodoPagoService $metodoPagoService)
    {
        $this->metodoPagoService = $metodoPagoService;
    }

    public function index()
    {
        return response()->json($this->metodoPagoService->obtenerTodos());
    }

    public function show($id)
    {
        $metodo = $this->metodoPagoService->obtenerPorId($id);

        if (!$metodo) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        return response()->json($metodo);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Metodo_pago' => 'required|string|max:255',
        ]);

        $metodo = $this->metodoPagoService->crear($data);

        return response()->json($metodo, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Metodo_pago' => 'required|string|max:255',
        ]);

        $metodo = $this->metodoPagoService->actualizar($id, $data);

        if (!$metodo) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        return response()->json($metodo);
    }

    public function destroy($id)
    {
        $eliminado = $this->metodoPagoService->eliminar($id);

        if (!$eliminado) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        return response()->json(['message' => 'Método de pago eliminado correctamente']);
    }
}
