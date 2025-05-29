<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Roles\RolService;

class RolController extends Controller
{
    protected $rolService;

    public function __construct(RolService $rolService)
    {
        $this->rolService = $rolService;
    }

    public function index()
    {
        return response()->json($this->rolService->getAll());
    }

    public function show($id)
    {
        $rol = $this->rolService->find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json($rol);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_rol' => 'required|string|max:255',
        ]);

        $rol = $this->rolService->create($validated);

        return response()->json($rol, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre_rol' => 'required|string|max:255',
        ]);

        $rol = $this->rolService->update($id, $validated);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json($rol);
    }

    public function destroy($id)
    {
        $deleted = $this->rolService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json(['message' => 'Rol eliminado correctamente']);
    }
}
