<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Producto\ProductoService;

class ProductoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ProductoService $productoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productoService = new ProductoService();
    }

    public function test_crea_producto_correctamente()
    {
        $data = [
            'Nombre' => 'Shampoo',
            'Cantidad' => 10,
            'Precio' => 45.99,
            'imagen' => 'img.png',
            'id_categoria' => \App\Models\Categoria::factory()->create()->id_categoria,
        ];

        $producto = $this->productoService->crear($data);

        $this->assertDatabaseHas('producto', ['Nombre' => 'Shampoo']);
        $this->assertInstanceOf(Producto::class, $producto);
    }

    public function test_obtiene_todos_los_productos()
    {
        Producto::factory()->count(3)->create();

        $productos = $this->productoService->obtenerTodos();

        $this->assertCount(3, $productos);
    }

    public function test_obtiene_producto_por_id()
    {
        $producto = Producto::factory()->create();

        $encontrado = $this->productoService->obtenerPorId($producto->idProducto);

        $this->assertNotNull($encontrado);
        $this->assertEquals($producto->idProducto, $encontrado->idProducto);
    }

    public function test_retorna_null_si_producto_no_existe()
    {
        $producto = $this->productoService->obtenerPorId(999);
        $this->assertNull($producto);
    }

    public function test_actualiza_producto_correctamente()
    {
        $producto = Producto::factory()->create();

        $datosActualizados = [
            'Nombre' => 'Gel fijador',
            'Precio' => 29.99
        ];

        $actualizado = $this->productoService->actualizar($producto->idProducto, $datosActualizados);

        $this->assertNotNull($actualizado);
        $this->assertEquals('Gel fijador', $actualizado->Nombre);
        $this->assertEquals(29.99, $actualizado->Precio);
    }

    public function test_estadisticas_de_productos()
    {
        Producto::factory()->create(['Precio' => 10, 'Cantidad' => 5]);
        Producto::factory()->create(['Precio' => 20, 'Cantidad' => 3]);

        $estadisticas = $this->productoService->obtenerEstadisticas();

        $this->assertEquals(2, $estadisticas['total_productos']);
        $this->assertEquals(15, $estadisticas['precio_promedio']);
        $this->assertEquals(20, $estadisticas['precio_maximo']);
        $this->assertEquals(10, $estadisticas['precio_minimo']);
        $this->assertEquals(8, $estadisticas['stock_total']);
    }

    public function test_datos_para_pdf()
    {
        Producto::factory()->count(2)->create();

        $datos = $this->productoService->obtenerDatosPDF();

        $this->assertArrayHasKey('productos', $datos);
        $this->assertArrayHasKey('estadisticas', $datos);
        $this->assertCount(2, $datos['productos']);
    }
}
