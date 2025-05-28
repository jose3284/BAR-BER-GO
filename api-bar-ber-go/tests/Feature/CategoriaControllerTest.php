<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriaControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_categorias()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->getJson('/api/categorias');

        $response->assertStatus(200)
                 ->assertJsonFragment(['categoria' => $categoria->categoria]);
    }

    /** @test */
    public function puede_mostrar_una_categoria()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->getJson("/api/categorias/{$categoria->id_categoria}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['categoria' => $categoria->categoria]);
    }

    /** @test */
    public function puede_crear_una_categoria()
    {
        $data = ['categoria' => 'Nueva categoría'];

        $response = $this->postJson('/api/categorias', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('categoria', $data);
    }

    /** @test */
    public function puede_actualizar_una_categoria()
    {
        $categoria = Categoria::factory()->create();

        $data = ['categoria' => 'Actualizada'];

        $response = $this->putJson("/api/categorias/{$categoria->id_categoria}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('categoria', $data);
    }

    /** @test */
    public function puede_eliminar_una_categoria()
    {
        $categoria = Categoria::factory()->create();

        $response = $this->deleteJson("/api/categorias/{$categoria->id_categoria}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Categoría eliminada correctamente']);

        $this->assertDatabaseMissing('categoria', ['id_categoria' => $categoria->id_categoria]);
    }
}
