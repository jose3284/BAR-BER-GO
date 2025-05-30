<?php

namespace App\Services;

use App\Mail\ResetPasswordMail;
use App\Models\Usuario;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;

class PasswordResetService
{
    public function sendResetToken(array $data): JsonResponse
    {
        $usuario = Usuario::where('Correo', $data['Correo'])->first();

        if (!$usuario) {
            return response()->json(['message' => 'Correo no registrado'], 404);
        }

        $token = Str::random(64);
        $usuario->reset_token = $token;
        $usuario->reset_expiration = Carbon::now()->addMinutes(30);
        $usuario->save();

        // Envía el mailable personalizado
        Mail::to($usuario->Correo)->send(new ResetPasswordMail($token, $usuario->Correo));

        return response()->json(['message' => 'Correo de recuperación enviado']);
    }

    public function resetPassword(array $data): JsonResponse
    {
        $usuario = Usuario::where('Correo', $data['Correo'])
                          ->where('reset_token', $data['token'])
                          ->first();

        if (!$usuario || Carbon::parse($usuario->reset_expiration)->isPast()) {
            return response()->json(['message' => 'Token inválido o expirado'], 400);
        }

        $usuario->Pass = Hash::make($data['new_password']);
        $usuario->reset_token = null;
        $usuario->reset_expiration = null;
        $usuario->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente']);
    }
}
