<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserState
{
    public function handle(Request $request, Closure $next)
    {
        $user = Session::get('user');

        if ($user) {
            if ($user['userState'] == 0) {
                // Usuario activo, continuar al Dashboard
                return redirect()->route('dashboard');
            } else {
                // Usuario inactivo
                return response("⚠️ Usuario inactivo. Contacte al administrador.");
            }
        }

        // No hay sesión → redirigir al login
        return redirect()->route('login');
    }
}
