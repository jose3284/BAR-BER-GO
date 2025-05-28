<?php

namespace App\Repositories;

use App\Models\Cita;

class CitaRepository
{
    public function getAllCitas()
    {
        return Cita::all(); // Puedes aplicar filtros según el usuario o fecha
    }
}
