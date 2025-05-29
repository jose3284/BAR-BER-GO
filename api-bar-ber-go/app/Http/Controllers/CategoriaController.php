<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Services\Categoria\Interfaces\CategoriaServiceInterface;

class CategoriaController extends Controller
{
    protected CategoriaServiceInterface $categoriaService;

    public function __construct(CategoriaServiceInterface $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->categoriaService->all());
    }

    public function show(Categoria $categoria): JsonResponse
    {
        return response()->json($this->categoriaService->find($categoria));
    }

    public function store(StoreCategoriaRequest $request): JsonResponse
    {
        $categoria = $this->categoriaService->create($request->validated());
        return response()->json($categoria, 201);
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): JsonResponse
    {
        $categoria = $this->categoriaService->update($categoria, $request->validated());
        return response()->json($categoria);
    }

    public function destroy(Categoria $categoria): JsonResponse
    {
        $this->categoriaService->delete($categoria);
        return response()->json(['message' => 'Categoría eliminada correctamente']);
    }
}
