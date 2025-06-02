<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Rol;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RolControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_listar_roles()
    {
        Rol::factory()->count(3)->create();

        $response = $this->getJson('/api/roles');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function puede_ver_un_rol()
    {
        $rol = Rol::factory()->create();

        $response = $this->getJson("/api/roles/{$rol->id_roles}");

        $response->assertStatus(200)
                 ->assertJson([
                     'id_roles' => $rol->id_roles,
                     'nombre_rol' => $rol->nombre_rol,
                 ]);
    }

    /** @test */
    public function devuelve_404_si_rol_no_existe()
    {
        $response = $this->getJson('/api/roles/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Rol no encontrado',
                 ]);
    }

    /** @test */
    public function puede_crear_un_rol()
    {
        $data = ['nombre_rol' => 'Administrador'];

        $response = $this->postJson('/api/roles', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('roles', $data);
    }

    /** @test */
    public function puede_actualizar_un_rol()
    {
        $rol = Rol::factory()->create([
            'nombre_rol' => 'Usuario',
        ]);

        $data = ['nombre_rol' => 'Supervisor'];

        $response = $this->putJson("/api/roles/{$rol->id_roles}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('roles', array_merge(['id_roles' => $rol->id_roles], $data));
    }

    /** @test */
    public function actualizar_rol_no_existente_devuelve_404()
    {
        $data = ['nombre_rol' => 'Gerente'];

        $response = $this->putJson('/api/roles/999', $data);

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Rol no encontrado',
                 ]);
    }

    /** @test */
    public function puede_eliminar_un_rol()
    {
        $rol = Rol::factory()->create();

        $response = $this->deleteJson("/api/roles/{$rol->id_roles}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Rol eliminado correctamente',
                 ]);

        $this->assertDatabaseMissing('roles', [
            'id_roles' => $rol->id_roles,
        ]);
    }

    /** @test */
    public function eliminar_rol_no_existente_devuelve_404()
    {
        $response = $this->deleteJson('/api/roles/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'message' => 'Rol no encontrado',
                 ]);
    }
}
