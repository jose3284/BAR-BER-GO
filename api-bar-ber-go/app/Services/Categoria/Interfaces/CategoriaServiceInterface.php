<?php

namespace App\Services\Categoria\Interfaces;

use App\Models\Categoria;
use Illuminate\Support\Collection;

interface CategoriaServiceInterface
{
    public function all(): Collection;
    public function find(Categoria $categoria): Categoria;
    public function create(array $data): Categoria;
    public function update(Categoria $categoria, array $data): Categoria;
    public function delete(Categoria $categoria): bool;
}
