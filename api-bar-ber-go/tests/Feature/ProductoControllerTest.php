<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_productos()
    {
        Categoria::factory()->create(); // Para asegurar que haya categoría
        Producto::factory()->count(3)->create();

        $response = $this->getJson('/api/producto');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function puede_mostrar_un_producto()
    {
        $categoria = Categoria::factory()->create();
        $producto = Producto::factory()->create([
            'id_categoria' => $categoria->id_categoria,
        ]);

        $response = $this->getJson('/api/producto/' . $producto->idProducto);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'Nombre' => $producto->Nombre,
                 ]);
    }

    /** @test */
    public function retorna_404_si_producto_no_existe()
    {
        $response = $this->getJson('/api/producto/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Producto no encontrado']);
    }

    /** @test */
    public function puede_crear_un_producto()
    {
        $categoria = Categoria::factory()->create();

        $data = [
            'Nombre' => 'Nuevo producto',
            'Cantidad' => 50,
            'Precio' => 99.99,
            'imagen' => 'nuevo.jpg',
            'id_categoria' => $categoria->id_categoria
        ];

        $response = $this->postJson('/api/producto', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['Nombre' => 'Nuevo producto']);

        $this->assertDatabaseHas('producto', ['Nombre' => 'Nuevo producto']);
    }

    /** @test */
    public function puede_actualizar_un_producto()
    {
        $categoria = Categoria::factory()->create();
        $producto = Producto::factory()->create([
            'id_categoria' => $categoria->id_categoria,
        ]);

        $response = $this->putJson('/api/producto/' . $producto->idProducto, [
            'Nombre' => 'Actualizado',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['Nombre' => 'Actualizado']);

        $this->assertDatabaseHas('producto', ['Nombre' => 'Actualizado']);
    }

    /** @test */
    public function puede_eliminar_un_producto()
    {
        $categoria = Categoria::factory()->create();
        $producto = Producto::factory()->create([
            'id_categoria' => $categoria->id_categoria,
        ]);

        $response = $this->deleteJson('/api/producto/' . $producto->idProducto);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Producto eliminado correctamente']);

        $this->assertDatabaseMissing('producto', ['idProducto' => $producto->idProducto]);
    }
}
