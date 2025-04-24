<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPago;

class MetodoPagoController extends Controller
{
    // GET /api/metodo-pago
    public function index()
    {
        $metodos = MetodoPago::all();
        return response()->json($metodos);
    }

    // GET /api/metodo-pago/{id}
    public function show($id)
    {
        $metodo = MetodoPago::find($id);

        if (!$metodo) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        return response()->json($metodo);
    }

    // POST /api/metodo-pago
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Metodo_pago' => 'required|string|max:255',
        ]);

        $metodo = MetodoPago::create($validated);

        return response()->json($metodo, 201);
    }

    // PUT /api/metodo-pago/{id}
    public function update(Request $request, $id)
    {
        $metodo = MetodoPago::find($id);

        if (!$metodo) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        $validated = $request->validate([
            'Metodo_pago' => 'required|string|max:255',
        ]);

        $metodo->update($validated);

        return response()->json($metodo);
    }

    // DELETE /api/metodo-pago/{id}
    public function destroy($id)
    {
        $metodo = MetodoPago::find($id);

        if (!$metodo) {
            return response()->json(['message' => 'Método de pago no encontrado'], 404);
        }

        $metodo->delete();

        return response()->json(['message' => 'Método de pago eliminado correctamente']);
    }
}
