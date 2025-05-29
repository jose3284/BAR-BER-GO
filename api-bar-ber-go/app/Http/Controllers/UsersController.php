<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Usuarios\UsuarioService;

class UsersController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    // GET /usuarios
    public function UserIndex()
    {
        return response()->json($this->usuarioService->getAll(), 200);
    }

    // GET /usuarios/{id}
    public function UserShow($id)
    {
        $usuario = $this->usuarioService->getById($id);

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

        $usuario = $this->usuarioService->create($validated);
        return response()->json($usuario, 201);
    }

    // PUT /usuarios/{id}
    public function UserUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'Nombre' => 'sometimes|required|string|max:255',
            'P_apellido' => 'sometimes|required|string|max:255',
            'S_apellido' => 'nullable|string|max:255',
            'Pass' => 'nullable|string|min:6',
            'Correo' => 'sometimes|required|email|unique:usuarios,Correo,' . $id . ',idUsuario',
            'id_roles' => 'sometimes|required|integer'
        ]);

        $usuario = $this->usuarioService->update($id, $validated);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario, 200);
    }

    // DELETE /usuarios/{id}
    public function UserDestroy($id)
    {
        $deleted = $this->usuarioService->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
