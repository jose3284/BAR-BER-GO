<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;

class CategoriaController extends Controller
{
    // GET /api/categorias
    public function index(): JsonResponse
    {
        return response()->json(Categoria::all());
    }

    // GET /api/categorias/{categoria}
    public function show(Categoria $categoria): JsonResponse
    {
        return response()->json($categoria);
    }

    // POST /api/categorias
    public function store(StoreCategoriaRequest $request): JsonResponse
    {
        $categoria = Categoria::create($request->validated());
        return response()->json($categoria, 201);
    }

    // PUT /api/categorias/{categoria}
    public function update(UpdateCategoriaRequest $request, Categoria $categoria): JsonResponse
    {
        $categoria->update($request->validated());
        return response()->json($categoria);
    }

    // DELETE /api/categorias/{categoria}
    public function destroy(Categoria $categoria): JsonResponse
    {
        $categoria->delete();
        return response()->json(['message' => 'Categoría eliminada correctamente']);
    }
}
