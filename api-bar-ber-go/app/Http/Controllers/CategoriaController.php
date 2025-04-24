<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // GET /api/categorias
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    // GET /api/categorias/{id}
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        return response()->json($categoria);
    }

    // POST /api/categorias
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoria' => 'required|string|max:255',
        ]);

        $categoria = Categoria::create($validated);

        return response()->json($categoria, 201);
    }

    // PUT /api/categorias/{id}
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $validated = $request->validate([
            'categoria' => 'required|string|max:255',
        ]);

        $categoria->update($validated);

        return response()->json($categoria);
    }

    // DELETE /api/categorias/{id}
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }

        $categoria->delete();

        return response()->json(['message' => 'Categoría eliminada correctamente']);
    }
}
