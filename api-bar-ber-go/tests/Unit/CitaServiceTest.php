<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Cita;
use App\Services\Cita\CitaService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CitaServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $citaService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->citaService = new CitaService();
    }

    public function test_crea_cita_correctamente()
    {
        $data = [
            'nombre' => 'Juan Pérez',
            'celular' => '123456789',
            'correo' => 'juan@example.com',
            'fecha' => '2025-06-15',
            'hora' => '14:00',
        ];

        $cita = $this->citaService->create($data);

        $this->assertDatabaseHas('cita', $data);
        $this->assertEquals('Juan Pérez', $cita->nombre);
    }

    public function test_obtiene_todas_las_citas()
    {
        Cita::factory()->count(3)->create();

        $citas = $this->citaService->getAll();

        $this->assertCount(3, $citas);
    }

    public function test_obtiene_cita_por_id()
    {
        $cita = Cita::factory()->create();

        $encontrada = $this->citaService->find($cita->id);

        $this->assertNotNull($encontrada);
        $this->assertEquals($cita->id, $encontrada->id);
    }

    public function test_actualiza_cita_correctamente()
    {
        $cita = Cita::factory()->create();

        $data = ['nombre' => 'Nombre Actualizado'];

        $actualizada = $this->citaService->update($cita->id, $data);

        $this->assertNotNull($actualizada);
        $this->assertEquals('Nombre Actualizado', $actualizada->nombre);
    }

    public function test_elimina_cita_correctamente()
    {
        $cita = Cita::factory()->create();

        $resultado = $this->citaService->delete($cita->id);

        $this->assertTrue($resultado);
        $this->assertDatabaseMissing('cita', ['id' => $cita->id]);
    }

    public function test_estadisticas_de_citas()
    {
        Cita::factory()->create([
            'fecha' => now()->toDateString(),
        ]);

        $stats = $this->citaService->getEstadisticas();

        $this->assertEquals(1, $stats['total_citas']);
        $this->assertEquals(1, $stats['citas_hoy']);
        $this->assertNotNull($stats['primer_cita']);
        $this->assertNotNull($stats['ultima_cita']);
    }
}
