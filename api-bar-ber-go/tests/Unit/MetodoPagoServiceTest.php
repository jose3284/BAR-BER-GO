<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\MetodoPago;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\MetodoPago\MetodoPagoService;

class MetodoPagoServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $metodoPagoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->metodoPagoService = new MetodoPagoService();
    }

    public function test_crea_metodo_pago_correctamente()
    {
        $data = ['Metodo_pago' => 'Crédito'];

        $metodo = $this->metodoPagoService->crear($data);

        $this->assertDatabaseHas('metodo_pago', $data);
        $this->assertEquals('Crédito', $metodo->Metodo_pago);
    }

    public function test_obtiene_todos_los_metodos_pago()
    {
        MetodoPago::factory()->count(3)->create();

        $todos = $this->metodoPagoService->obtenerTodos();

        $this->assertCount(3, $todos);
    }

    public function test_obtiene_metodo_pago_por_id()
    {
        $metodo = MetodoPago::factory()->create();

        $encontrado = $this->metodoPagoService->obtenerPorId($metodo->idMetodo_pago);

        $this->assertNotNull($encontrado);
        $this->assertEquals($metodo->idMetodo_pago, $encontrado->idMetodo_pago);
    }

    public function test_retorna_null_si_no_encuentra_metodo_pago()
    {
        $this->assertNull($this->metodoPagoService->obtenerPorId(999));
    }

    public function test_actualiza_metodo_pago_correctamente()
    {
        $metodo = MetodoPago::factory()->create([
            'Metodo_pago' => 'Efectivo',
        ]);

        $actualizado = $this->metodoPagoService->actualizar($metodo->idMetodo_pago, [
            'Metodo_pago' => 'Tarjeta',
        ]);

        $this->assertNotNull($actualizado);
        $this->assertEquals('Tarjeta', $actualizado->Metodo_pago);
    }

    public function test_elimina_metodo_pago_correctamente()
    {
        $metodo = MetodoPago::factory()->create();

        $resultado = $this->metodoPagoService->eliminar($metodo->idMetodo_pago);

        $this->assertTrue($resultado);
        $this->assertDatabaseMissing('metodo_pago', [
            'idMetodo_pago' => $metodo->idMetodo_pago
        ]);
    }

    public function test_eliminar_metodo_pago_inexistente_retorna_false()
    {
        $this->assertFalse($this->metodoPagoService->eliminar(999));
    }
}
