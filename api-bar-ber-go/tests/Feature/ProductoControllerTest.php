<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_retorna_lista_de_productos()
    {
        Producto::factory()->count(3)->create();

        $response = $this->getJson('/api/producto');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_show_retorna_producto_existente()
    {
        $producto = Producto::factory()->create();

        $response = $this->getJson("/api/producto/{$producto->idProducto}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['idProducto' => $producto->idProducto]);
    }

    public function test_show_devuelve_404_si_producto_no_existe()
    {
        $response = $this->getJson('/api/producto/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Producto no encontrado']);
    }

    public function test_store_crea_nuevo_producto()
    {
        $categoria = Categoria::factory()->create();

        $data = [
            'Nombre' => 'Producto Test',
            'Cantidad' => 10,
            'Precio' => 99.99,
            'imagen' => 'http://example.com/image.jpg',
            'id_categoria' => $categoria->id_categoria
        ];

        $response = $this->postJson('/api/producto', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['Nombre' => 'Producto Test']);

        $this->assertDatabaseHas('producto', ['Nombre' => 'Producto Test']);
    }

    public function test_update_modifica_producto_existente()
    {
        $producto = Producto::factory()->create();

        $data = [
            'Nombre' => 'Producto Actualizado',
            'Precio' => 123.45
        ];

        $response = $this->putJson("/api/producto/{$producto->idProducto}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment(['Nombre' => 'Producto Actualizado']);

        $this->assertDatabaseHas('producto', ['idProducto' => $producto->idProducto, 'Nombre' => 'Producto Actualizado']);
    }

    public function test_update_devuelve_404_si_producto_no_existe()
    {
        $response = $this->putJson('/api/producto/999', ['Nombre' => 'Inexistente']);

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Producto no encontrado']);
    }

    public function test_destroy_elimina_producto_existente()
    {
        $producto = Producto::factory()->create();

        $response = $this->deleteJson("/api/producto/{$producto->idProducto}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Producto eliminado correctamente']);

        $this->assertDatabaseMissing('producto', ['idProducto' => $producto->idProducto]);
    }

    public function test_destroy_devuelve_404_si_producto_no_existe()
    {
        $response = $this->deleteJson('/api/producto/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Producto no encontrado']);
    }
}
