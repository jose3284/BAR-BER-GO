<?php

namespace App\Services;

use App\Models\Recibo;

class ReciboService
{
    public function obtenerTodos()
    {
        return Recibo::with(['producto', 'metodoPago', 'usuario'])->get();
    }

    public function obtenerPorId($id)
    {
        return Recibo::with(['producto', 'metodoPago', 'usuario'])->find($id);
    }

    public function crear(array $datos)
    {
        return Recibo::create($datos);
    }

    public function actualizar(Recibo $recibo, array $datos)
    {
        $recibo->update($datos);
        return $recibo;
    }

    public function eliminar(Recibo $recibo)
    {
        $recibo->delete();
        return true;
    }
}
