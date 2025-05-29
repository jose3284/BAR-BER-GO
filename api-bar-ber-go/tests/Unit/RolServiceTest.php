<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Rol;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Roles\RolService;

class RolServiceTest extends TestCase
{
    use RefreshDatabase;

    protected RolService $rolService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rolService = new RolService();
    }

    public function test_crea_rol_correctamente()
    {
        $data = ['nombre_rol' => 'Administrador'];

        $rol = $this->rolService->create($data);

        $this->assertDatabaseHas('roles', ['nombre_rol' => 'Administrador']);
        $this->assertInstanceOf(Rol::class, $rol);
        $this->assertEquals('Administrador', $rol->nombre_rol);
    }

    public function test_obtiene_todos_los_roles()
    {
        Rol::factory()->count(3)->create();

        $roles = $this->rolService->getAll();

        $this->assertCount(3, $roles);
    }

    public function test_obtiene_rol_por_id()
    {
        $rol = Rol::factory()->create(['nombre_rol' => 'Editor']);

        $resultado = $this->rolService->find($rol->id_roles);

        $this->assertNotNull($resultado);
        $this->assertEquals('Editor', $resultado->nombre_rol);
    }

    public function test_retorna_null_si_rol_no_existe()
    {
        $resultado = $this->rolService->find(999);

        $this->assertNull($resultado);
    }

    public function test_actualiza_rol_correctamente()
    {
        $rol = Rol::factory()->create(['nombre_rol' => 'Usuario']);

        $updated = $this->rolService->update($rol->id_roles, ['nombre_rol' => 'SuperUsuario']);

        $this->assertNotNull($updated);
        $this->assertEquals('SuperUsuario', $updated->nombre_rol);
        $this->assertDatabaseHas('roles', ['nombre_rol' => 'SuperUsuario']);
    }

    public function test_elimina_rol_correctamente()
    {
        $rol = Rol::factory()->create();

        $resultado = $this->rolService->delete($rol->id_roles);

        $this->assertTrue($resultado);
        $this->assertDatabaseMissing('roles', ['id_roles' => $rol->id_roles]);
    }

    public function test_eliminar_rol_inexistente_retorna_false()
    {
        $resultado = $this->rolService->delete(999);

        $this->assertFalse($resultado);
    }
}
