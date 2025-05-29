<?php

namespace App\Services\Categoria;

use App\Models\Categoria;
use Illuminate\Support\Collection;
use App\Services\Categoria\Interfaces\CategoriaServiceInterface;

class CategoriaService implements CategoriaServiceInterface
{
    public function all(): Collection
    {
        return Categoria::all();
    }

    public function find(Categoria $categoria): Categoria
    {
        return $categoria;
    }

    public function create(array $data): Categoria
    {
        return Categoria::create($data);
    }

    public function update(Categoria $categoria, array $data): Categoria
    {
        $categoria->update($data);
        return $categoria;
    }

    public function delete(Categoria $categoria): bool
    {
        return $categoria->delete();
    }
}
