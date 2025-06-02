<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Recibo;
use App\Models\Producto;
use App\Models\MetodoPago;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReciboControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_retorna_lista_de_recibos()
    {
        Recibo::factory()->count(3)->create();

        $response = $this->getJson('/api/recibos');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_show_retornar_recibo_existente()
    {
        $recibo = Recibo::factory()->create();

        $response = $this->getJson("/api/recibos/{$recibo->idRecibo}");

      $response->assertStatus(200)
         ->assertJsonFragment(['idRecibo' => $recibo->idRecibo]);
    }

    public function test_show_devuelve_404_si_no_existe()
    {
        $response = $this->getJson('/api/recibos/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Recibo no encontrado']);
    }

    public function test_store_crea_un_nuevo_recibo()
    {
        $producto = Producto::factory()->create();
        $metodo = MetodoPago::factory()->create();
        $usuario = Usuario::factory()->create();

        $data = [
            'Fecha' => now()->toDateString(),
            'Hora' => now()->format('H:i:s'),
            'Total' => 150.50,
            'Producto_idProducto' => $producto->idProducto,
            'Metodo_pago_idMetodo_pago' => $metodo->idMetodo_pago,
            'Usuarios_idUsuario' => $usuario->idUsuario,
        ];

        $response = $this->postJson('/api/recibos', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['Total' => 150.50]);

        $this->assertDatabaseHas('recibo', ['Total' => 150.50]);
    }

    public function test_update_modifica_un_recibo_existente()
    {
        $recibo = Recibo::factory()->create();

        $response = $this->putJson("/api/recibos/{$recibo->idRecibo}", [
            'Total' => 999.99,
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['Total' => 999.99]);

        $this->assertDatabaseHas('recibo', ['idRecibo' => $recibo->idRecibo, 'Total' => 999.99]);
    }

    public function test_update_devuelve_404_si_el_recibo_no_existe()
    {
        $response = $this->putJson('/api/recibos/999', ['Total' => 999]);

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Recibo no encontrado']);
    }

    public function test_destroy_elimina_recibo_existente()
    {
        $recibo = Recibo::factory()->create();

        $response = $this->deleteJson("/api/recibos/{$recibo->idRecibo}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Recibo eliminado correctamente']);

        $this->assertDatabaseMissing('recibo', ['idRecibo' => $recibo->idRecibo]);
    }

    public function test_destroy_devuelve_404_si_no_existe()
    {
        $response = $this->deleteJson('/api/recibos/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Recibo no encontrado']);
    }
}
