<?php

namespace App\Services\MetodoPago;

use App\Models\MetodoPago;

class MetodoPagoService
{
    public function obtenerTodos()
    {
        return MetodoPago::all();
    }

    public function obtenerPorId($id)
    {
        return MetodoPago::find($id);
    }

    public function crear(array $data)
    {
        return MetodoPago::create($data);
    }

    public function actualizar($id, array $data)
    {
        $metodo = MetodoPago::find($id);

        if (!$metodo) {
            return null;
        }

        $metodo->update($data);
        return $metodo;
    }

    public function eliminar($id)
    {
        $metodo = MetodoPago::find($id);

        if (!$metodo) {
            return false;
        }

        $metodo->delete();
        return true;
    }
}
