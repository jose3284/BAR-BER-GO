<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\JsonResponse;

class AuthService
{
    public function login(array $data): JsonResponse
    {
        $usuario = Usuario::where('Correo', $data['Correo'])->first();

        if (!$usuario || !Hash::check($data['Pass'], $usuario->Pass)) {
            return response()->json(['message' => 'Correo o contraseña incorrectos'], 401);
        }

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario
        ]);
    }

    public function logout(): JsonResponse
    {
        request()->user()->tokens()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
}
