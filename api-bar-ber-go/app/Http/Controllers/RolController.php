<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    // GET /api/roles
    public function RolIndex()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    // GET /api/roles/{id}
    public function RolShow($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json($rol);
    }

    // POST /api/roles
    public function RolStore(Request $request)
    {
        $validated = $request->validate([
            'nombre_rol' => 'required|string|max:255',
        ]);

        $rol = Rol::create($validated);

        return response()->json($rol, 201);
    }

    // PUT /api/roles/{id}
    public function RolUpdate(Request $request, $id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $validated = $request->validate([
            'nombre_rol' => 'required|string|max:255',
        ]);

        $rol->update($validated);

        return response()->json($rol);
    }

    // DELETE /api/roles/{id}
    public function RolDestroy($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $rol->delete();

        return response()->json(['message' => 'Rol eliminado correctamente']);
    }
}

