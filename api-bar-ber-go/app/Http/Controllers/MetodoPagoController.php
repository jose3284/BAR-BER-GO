<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MetodoPagoService;

class MetodoPagoController extends Controller
{
    protected $metodoPagoService;

    public function __construct(MetodoPagoService $metodoPagoService)
    {
        $this->metodoPagoService = $metodoPagoService;
    }

    public function index()
    {
        return response()->json($this->metodoPagoService->getAll());
    }

    public function show($id)
    {
        $metodo = $this->metodoPagoService->find($id);

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

        $metodo = $this->metodoPagoService->create($data);

        return response()->json($metodo, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Metodo_pago' => 'required|string|max:255',
        ]);

        $metodo = $this->metodoPagoService->update($id, $data);

        if (!$metodo) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        return response()->json($metodo);
    }

    public function destroy($id)
    {
        $deleted = $this->metodoPagoService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        return response()->json(['message' => 'Método de pago eliminado correctamente']);
    }
}
