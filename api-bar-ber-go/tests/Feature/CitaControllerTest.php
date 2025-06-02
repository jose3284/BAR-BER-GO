<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Reportes\ReportePDFService;
use Illuminate\Support\Facades\App;

class CitaControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_citas()
    {
        Cita::factory()->count(3)->create();

        $response = $this->getJson('/api/cita');

        $response->assertStatus(200)->assertJsonCount(3);
    }

    /** @test */
    public function puede_mostrar_una_cita()
    {
        $cita = Cita::factory()->create();

        $response = $this->getJson('/api/cita/' . $cita->id);

        $response->assertStatus(200)->assertJsonFragment([
            'nombre' => $cita->nombre,
        ]);
    }

    /** @test */
    public function devuelve_404_si_la_cita_no_existe()
    {
        $response = $this->getJson('/api/cita/999');

        $response->assertStatus(404)->assertJson([
            'message' => 'Cita no encontrada',
        ]);
    }

    /** @test */
    public function puede_crear_una_cita()
    {
        $data = [
            'nombre' => 'Juan Pérez',
            'celular' => '123456789',
            'correo' => 'juan@example.com',
            'fecha' => '2025-06-01',
            'hora' => '14:00',
        ];

        $response = $this->postJson('/api/cita', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
        $this->assertDatabaseHas('cita', $data);
    }

    /** @test */
    public function valida_datos_al_crear_una_cita()
    {
        $response = $this->postJson('/api/cita', []);

        $response->assertStatus(422)->assertJsonValidationErrors([
            'nombre', 'celular', 'correo', 'fecha', 'hora'
        ]);
    }

    /** @test */
    public function puede_actualizar_una_cita()
    {
        $cita = Cita::factory()->create();

        $response = $this->putJson('/api/cita/' . $cita->id, [
            'nombre' => 'Nuevo Nombre'
        ]);

        $response->assertStatus(200)->assertJsonFragment([
            'nombre' => 'Nuevo Nombre'
        ]);

        $this->assertDatabaseHas('cita', ['id' => $cita->id, 'nombre' => 'Nuevo Nombre']);
    }

    /** @test */
    public function devuelve_404_si_la_cita_a_actualizar_no_existe()
    {
        $response = $this->putJson('/api/cita/999', ['nombre' => 'Test']);

        $response->assertStatus(404)->assertJson([
            'message' => 'Cita no encontrada',
        ]);
    }

    /** @test */
    public function puede_eliminar_una_cita()
    {
        $cita = Cita::factory()->create();

        $response = $this->deleteJson('/api/cita/' . $cita->id);

        $response->assertStatus(200)->assertJson([
            'message' => 'Cita eliminada con éxito',
        ]);

        $this->assertDatabaseMissing('cita', ['id' => $cita->id]);
    }

    /** @test */
    public function devuelve_404_si_la_cita_a_eliminar_no_existe()
    {
        $response = $this->deleteJson('/api/cita/999');

        $response->assertStatus(404)->assertJson([
            'message' => 'Cita no encontrada',
        ]);
    }

}
