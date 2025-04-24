<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'Correo' => 'required|email',
            'Pass' => 'required'
        ]);

        $usuario = Usuario::where('Correo', $request->Correo)->first();

        if (!$usuario || !Hash::check($request->Pass, $usuario->Pass)) {
            return response()->json([
                'message' => 'Correo o contraseña incorrectos'
            ], 401);
        }

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $usuario
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }

    // Enviar token de recuperación al correo
    public function forgotPassword(Request $request)
    {
        $request->validate(['Correo' => 'required|email']);

        $usuario = Usuario::where('Correo', $request->Correo)->first();
        if (!$usuario) {
            return response()->json(['message' => 'Correo no registrado'], 404);
        }

        $token = Str::random(64);
        $usuario->reset_token = $token;
        $usuario->reset_expiration = Carbon::now()->addMinutes(30);
        $usuario->save();

        // Enviar correo
        Mail::raw("Tu token de recuperación es: $token", function ($message) use ($usuario) {
            $message->to($usuario->Correo)
                    ->subject('Recuperación de contraseña');
        });

        return response()->json(['message' => 'Correo de recuperación enviado']);
    }

    // Cambiar la contraseña con el token
    public function resetPassword(Request $request)
    {
        $request->validate([
            'Correo' => 'required|email',
            'token' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $usuario = Usuario::where('Correo', $request->Correo)
                          ->where('reset_token', $request->token)
                          ->first();

        if (!$usuario || Carbon::parse($usuario->reset_expiration)->isPast()) {
            return response()->json(['message' => 'Token inválido o expirado'], 400);
        }

        $usuario->Pass = Hash::make($request->new_password);
        $usuario->reset_token = null;
        $usuario->reset_expiration = null;
        $usuario->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente']);
    }
}
