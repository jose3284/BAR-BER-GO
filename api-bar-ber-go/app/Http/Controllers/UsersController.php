<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // GET /usuarios
    public function UserIndex()
    {
        return response()->json(Usuario::all(), 200);
    }

    // GET /usuarios/{id}
    public function UserShow($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    // POST /usuarios
    public function UserStore(Request $request)
    {
        $validated = $request->validate([
            'Nombre' => 'required|string|max:255',
            'P_apellido' => 'required|string|max:255',
            'S_apellido' => 'nullable|string|max:255',
            'Pass' => 'required|string|min:6',
            'Correo' => 'required|email|unique:usuarios,Correo',
            'id_roles' => 'required|integer',
            'userState' => 'required|boolean'
        ]);
    
        // Encriptar la contraseña
        $validated['Pass'] = Hash::make($validated['Pass']);
    
        $usuario = Usuario::create($validated);
    
        return response()->json($usuario, 201);
    }
    
    // PUT /usuarios/{id}
    public function UserUpdate(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'Nombre' => 'sometimes|required|string|max:255',
            'P_apellido' => 'sometimes|required|string|max:255',
            'S_apellido' => 'nullable|string|max:255',
            'Pass' => 'nullable|string|min:6',
            'Correo' => 'sometimes|required|email|unique:usuarios,Correo,' . $usuario->idUsuario . ',idUsuario',
            'id_roles' => 'sometimes|required|integer'
        ]);

        // Encriptar nueva contraseña si fue enviada
        if (isset($validated['Pass'])) {
            $validated['Pass'] = Hash::make($validated['Pass']);
        }

        $usuario->update($validated);

        return response()->json($usuario, 200);
    }

    // DELETE /usuarios/{id}
    public function UserDestroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $usuario->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}