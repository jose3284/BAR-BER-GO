<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Recibo;
use App\Models\Producto;
use App\Models\MetodoPago;
use App\Models\Usuario;
use App\Services\ReciboService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ReciboServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ReciboService $reciboService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->reciboService = new ReciboService();
    }

    #[Test]
    public function crea_recibo_correctamente()
    {
        $producto = Producto::factory()->create();
        $metodoPago = MetodoPago::factory()->create();
        $usuario = Usuario::factory()->create();

        $datos = [
            'Fecha' => now()->toDateString(),
            'Hora' => now()->format('H:i:s'),
            'Total' => 120.50,
            'Producto_idProducto' => $producto->idProducto,
            'Metodo_pago_idMetodo_pago' => $metodoPago->idMetodo_pago,
            'Usuarios_idUsuario' => $usuario->idUsuario,
        ];

        $recibo = $this->reciboService->crear($datos);

        $this->assertDatabaseHas('recibo', $datos);
        $this->assertInstanceOf(Recibo::class, $recibo);
    }

    #[Test]
    public function obtiene_todos_los_recibos()
    {
        Recibo::factory()->count(3)->create();
        $recibos = $this->reciboService->obtenerTodos();
        $this->assertCount(3, $recibos);
    }

    #[Test]
    public function obtiene_recibo_por_id()
    {
        $recibo = Recibo::factory()->create();
        $encontrado = $this->reciboService->obtenerPorId($recibo->idRecibo);
        $this->assertEquals($recibo->idRecibo, $encontrado->idRecibo);
    }

    #[Test]
    public function actualiza_recibo_correctamente()
    {
        $recibo = Recibo::factory()->create([
            'Total' => 100.00,
        ]);

        $nuevosDatos = ['Total' => 200.00];
        $actualizado = $this->reciboService->actualizar($recibo, $nuevosDatos);

        $this->assertEquals(200.00, $actualizado->Total);
        $this->assertDatabaseHas('recibo', ['idRecibo' => $recibo->idRecibo, 'Total' => 200.00]);
    }

    #[Test]
    public function elimina_recibo_correctamente()
    {
        $recibo = Recibo::factory()->create();
        $resultado = $this->reciboService->eliminar($recibo);

        $this->assertTrue($resultado);
        $this->assertDatabaseMissing('recibo', ['idRecibo' => $recibo->idRecibo]);
    }
}
