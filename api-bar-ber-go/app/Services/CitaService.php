<?php

namespace App\Services;

use App\Models\Cita;

class CitaService
{
    public function getAll()
    {
        return Cita::all();
    }

    public function find($id)
    {
        return Cita::find($id);
    }

    public function create(array $data)
    {
        return Cita::create($data);
    }

    public function update($id, array $data)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return null;
        }

        $cita->update($data);
        return $cita;
    }

    public function delete($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return false;
        }

        return $cita->delete();
    }

    public function getEstadisticas()
    {
        return [
            'total_citas' => Cita::count(),
            'citas_por_fecha' => Cita::selectRaw('fecha, COUNT(*) as total')
                ->groupBy('fecha')
                ->orderBy('fecha', 'asc')
                ->get()
        ];
    }
}
