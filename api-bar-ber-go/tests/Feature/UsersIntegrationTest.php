<?php

namespace Tests\Feature;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UsersIntegrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_usuarios()
    {
        Usuario::factory()->count(3)->create();

        $response = $this->getJson('/api/usuarios');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function puede_mostrar_un_usuario()
    {
        $usuario = Usuario::factory()->create();

        $response = $this->getJson("/api/usuarios/{$usuario->idUsuario}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['Correo' => $usuario->Correo]);
    }

    /** @test */
    public function retorna_404_si_usuario_no_existe()
    {
        $response = $this->getJson("/api/usuarios/999");

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Usuario no encontrado']);
    }

    /** @test */
   public function puede_crear_un_usuario()
{
    $this->withoutExceptionHandling();

    // Crear un rol con ID 1
    Rol::factory()->create(['id_roles' => 1]);

    $data = [
        'Nombre' => 'Juan',
        'P_apellido' => 'Pérez',
        'S_apellido' => 'Gómez',
        'Pass' => 'secret123',
        'Correo' => 'juan@example.com',
        'id_roles' => 1,
        'userState' => true
    ];

    $response = $this->postJson('/api/usuarios', $data);

    $response->assertStatus(201)
             ->assertJsonFragment(['Correo' => 'juan@example.com']);

    $this->assertDatabaseHas('usuarios', ['Correo' => 'juan@example.com']);
}

    /** @test */
    public function puede_actualizar_un_usuario()
    {
        $usuario = Usuario::factory()->create();

        $response = $this->putJson("/api/usuarios/{$usuario->idUsuario}", [
            'Nombre' => 'NuevoNombre',
            'Correo' => 'nuevo@example.com',
            'id_roles' => $usuario->id_roles,
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['Nombre' => 'NuevoNombre']);
    }

    /** @test */
    public function puede_eliminar_un_usuario()
    {
        $usuario = Usuario::factory()->create();

        $response = $this->deleteJson("/api/usuarios/{$usuario->idUsuario}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Usuario eliminado correctamente']);

        $this->assertDatabaseMissing('usuarios', ['idUsuario' => $usuario->idUsuario]);
    }

    /** @test */
    public function eliminar_usuario_inexistente_retornara_404()
    {
        $response = $this->deleteJson('/api/usuarios/999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'Usuario no encontrado']);
    }
}
