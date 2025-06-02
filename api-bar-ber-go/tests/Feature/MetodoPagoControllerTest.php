<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\MetodoPago;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MetodoPagoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_metodos_pago()
    {
        MetodoPago::factory()->count(3)->create();

        $response = $this->getJson('/api/metodo-pago');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function puede_mostrar_un_metodo_pago_existente()
    {
        $metodo = MetodoPago::factory()->create();

        $response = $this->getJson('/api/metodo-pago/' . $metodo->idMetodo_pago);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'Metodo_pago' => $metodo->Metodo_pago,
                 ]);
    }

    /** @test */
    public function devuelve_404_si_metodo_pago_no_existe()
    {
        $response = $this->getJson('/api/metodo-pago/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Método de pago no encontrado',
                 ]);
    }

    /** @test */
    public function puede_crear_un_metodo_pago()
    {
        $data = ['Metodo_pago' => 'Pago móvil'];

        $response = $this->postJson('/api/metodo-pago', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('metodo_pago', $data);
    }

    /** @test */
    public function valida_datos_al_crear_metodo_pago()
    {
        $response = $this->postJson('/api/metodo-pago', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['Metodo_pago']);
    }

    /** @test */
    public function puede_actualizar_un_metodo_pago()
    {
        $metodo = MetodoPago::factory()->create();

        $nuevosDatos = ['Metodo_pago' => 'Tarjeta de crédito'];

        $response = $this->putJson('/api/metodo-pago/' . $metodo->idMetodo_pago, $nuevosDatos);

        $response->assertStatus(200)
                 ->assertJsonFragment($nuevosDatos);

        $this->assertDatabaseHas('metodo_pago', $nuevosDatos);
    }

    /** @test */
    public function devuelve_404_al_actualizar_si_no_existe()
    {
        $response = $this->putJson('/api/metodo-pago/999', ['Metodo_pago' => 'Cheque']);

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Método de pago no encontrado',
                 ]);
    }

    /** @test */
    public function puede_eliminar_un_metodo_pago()
    {
        $metodo = MetodoPago::factory()->create();

        $response = $this->deleteJson('/api/metodo-pago/' . $metodo->idMetodo_pago);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Método de pago eliminado correctamente',
                 ]);

        $this->assertDatabaseMissing('metodo_pago', [
            'idMetodo_pago' => $metodo->idMetodo_pago,
        ]);
    }

    /** @test */
    public function devuelve_404_al_eliminar_si_no_existe()
    {
        $response = $this->deleteJson('/api/metodo-pago/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Método de pago no encontrado',
                 ]);
    }
}
