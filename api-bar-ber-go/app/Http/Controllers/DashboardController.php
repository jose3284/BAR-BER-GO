<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Session::get('user');

        if (!$user) {
            return redirect()->route('login');
        }

        $rol_id = $user['id_roles'];

        // Mapeo de roles
        $rolesMap = [
            1 => 'admin',
            2 => 'barbero',
            3 => 'vendedor',
            4 => 'cliente',
        ];

        $rol = $rolesMap[$rol_id] ?? 'cliente';

        // 👇 Datos opcionales para el rol barbero
        $citas = [];
        if ($rol === 'barbero') {
            $citas = app(\App\Http\Controllers\CitaController::class)->index()->getData();
            }

        // Validación de vistas
        if (
            view()->exists("roles.$rol.header") &&
            view()->exists("roles.$rol.$rol") &&
            view()->exists("roles.$rol.footer")
        ) {
            return view('dashboard', [
                'rol' => $rol,
                'citas' => $citas
            ]);
        } else {
            return response("⚠️ No se encontraron las vistas para el rol '$rol'.");
        }
    }
}
