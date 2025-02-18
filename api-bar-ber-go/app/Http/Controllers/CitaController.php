<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    // Obtener todas las citas
public function index()
{
    $citas = Cita::all();
    return response()->json($citas, 200);
}

// Obtener una cita por ID
public function show($id)
{
    $cita = Cita::find($id);

    if (!$cita) {
        return response()->json(['message' => 'Cita no encontrada'], 404);
    }

    return response()->json($cita, 200);
}

// Crear una nueva cita
public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'celular' => 'required|string|max:20',
        'correo' => 'required|email|max:255',
        'fecha' => 'required|date',
        'hora' => 'required|date_format:H:i',  // Formato de hora: HH:MM
    ]);

    $cita = Cita::create([
        'nombre' => $request->nombre,
        'celular' => $request->celular,
        'correo' => $request->correo,
        'fecha' => $request->fecha,
        'hora' => $request->hora,
    ]);

    return response()->json($cita, 201);
}

// Actualizar una cita existente
public function update(Request $request, $id)
{
    $cita = Cita::find($id);

    if (!$cita) {
        return response()->json(['message' => 'Cita no encontrada'], 404);
    }

    $request->validate([
        'nombre' => 'sometimes|required|string|max:255',
        'celular' => 'sometimes|required|string|max:20',
        'correo' => 'sometimes|required|email|max:255',
        'fecha' => 'sometimes|required|date',
        'hora' => 'sometimes|required|date_format:H:i',  // Formato de hora: HH:MM
    ]);

    $cita->update([
        'nombre' => $request->nombre ?? $cita->nombre,
        'celular' => $request->celular ?? $cita->celular,
        'correo' => $request->correo ?? $cita->correo,
        'fecha' => $request->fecha ?? $cita->fecha,
        'hora' => $request->hora ?? $cita->hora,
    ]);

    return response()->json($cita, 200);
}

// Eliminar una cita
public function destroy($id)
{
    $cita = Cita::find($id);

    if (!$cita) {
        return response()->json(['message' => 'Cita no encontrada'], 404);
    }

    $cita->delete();

    return response()->json(['message' => 'Cita eliminada con éxito'], 200);
}

}
