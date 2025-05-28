<?php

namespace App\Services;

use App\Models\MetodoPago;

class MetodoPagoService
{
    public function getAll()
    {
        return MetodoPago::all();
    }

    public function find($id)
    {
        return MetodoPago::find($id);
    }

    public function create(array $data)
    {
        return MetodoPago::create($data);
    }

    public function update($id, array $data)
    {
        $metodo = MetodoPago::find($id);

        if (!$metodo) {
            return null;
        }

        $metodo->update($data);

        return $metodo;
    }

    public function delete($id)
    {
        $metodo = MetodoPago::find($id);

        if (!$metodo) {
            return false;
        }

        return $metodo->delete();
    }
}
