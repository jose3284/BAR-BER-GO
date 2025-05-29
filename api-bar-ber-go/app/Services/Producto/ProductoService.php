<?php

namespace App\Services\Producto;

use App\Models\Producto;

class ProductoService
{
    public function obtenerTodos()
    {
        return Producto::all();
    }

    public function obtenerPorId($id)
    {
        return Producto::find($id);
    }

    public function crear(array $data)
    {
        return Producto::create($data);
    }

    public function actualizar($id, array $data)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return null;
        }

        $producto->update($data);
        return $producto;
    }

    public function eliminar($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return false;
        }

        $producto->delete();
        return true;
    }

    public function obtenerEstadisticas()
    {
        return [
            'total_productos' => Producto::count(),
            'precio_promedio' => Producto::average('Precio'),
            'precio_maximo' => Producto::max('Precio'),
            'precio_minimo' => Producto::min('Precio'),
            'stock_total' => Producto::sum('Cantidad')
        ];
    }

    public function obtenerDatosPDF()
    {
        return [
            'productos' => Producto::all(),
            'estadisticas' => $this->obtenerEstadisticas()
        ];
    }
}
