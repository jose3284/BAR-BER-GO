<?php

namespace App\Services;

use App\Models\Producto;

class ProductoService
{
    public function getAll()
    {
        return Producto::all();
    }

    public function find($id)
    {
        return Producto::find($id);
    }

    public function create(array $data)
    {
        return Producto::create($data);
    }

    public function update($id, array $data)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return null;
        }
        $producto->update($data);
        return $producto;
    }

    public function delete($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return false;
        }
        return $producto->delete();
    }

    public function getEstadisticas()
    {
        $productos = Producto::all();
        return [
            'total_productos' => $productos->count(),
            'precio_promedio' => $productos->avg('Precio'),
            'precio_maximo' => $productos->max('Precio'),
            'precio_minimo' => $productos->min('Precio'),
        ];
    }

    public function getPDFData()
    {
        $productos = Producto::all();
        return [
            'producto' => $productos,
            'total' => $productos->count(),
            'fecha' => now()->toDateTimeString(),
        ];
    }
}
