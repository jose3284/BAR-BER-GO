<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Categoria\CategoriaService;

class CategoriaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected CategoriaService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CategoriaService();
    }

    
    public function crea_categoria_correctamente()
    {
        $data = ['categoria' => 'Bebidas'];
        $categoria = $this->service->create($data);

        $this->assertDatabaseHas('categoria', $data);
        $this->assertInstanceOf(Categoria::class, $categoria);
    }

    
    public function obtiene_todas_las_categorias()
    {
        Categoria::factory()->count(3)->create();
        $categorias = $this->service->all();

        $this->assertCount(3, $categorias);
    }

    
    public function obtiene_categoria_por_modelo()
    {
        $categoria = Categoria::factory()->create();
        $result = $this->service->find($categoria);

        $this->assertEquals($categoria->id_categoria, $result->id_categoria);
    }


    public function actualiza_categoria_correctamente()
    {
        $categoria = Categoria::factory()->create(['categoria' => 'Original']);
        $updated = $this->service->update($categoria, ['categoria' => 'Actualizado']);

        $this->assertEquals('Actualizado', $updated->categoria);
        $this->assertDatabaseHas('categoria', ['categoria' => 'Actualizado']);
    }

    
    public function elimina_categoria_correctamente()
    {
        $categoria = Categoria::factory()->create();
        $deleted = $this->service->delete($categoria);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('categoria', ['id_categoria' => $categoria->id_categoria]);
    }
}
