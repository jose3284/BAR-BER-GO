<?php

namespace App\Services\Cita;

use App\Models\Cita;
use App\Services\Cita\Interfaces\CitaServiceInterface;

class CitaService implements CitaServiceInterface
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

        $cita->delete();
        return true;
    }

    public function getEstadisticas()
    {
        return [
            'total_citas' => Cita::count(),
            'citas_hoy' => Cita::whereDate('fecha', now()->toDateString())->count(),
            'primer_cita' => Cita::min('fecha'),
            'ultima_cita' => Cita::max('fecha'),
        ];
    }
}
