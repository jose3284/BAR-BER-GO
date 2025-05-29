<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Services\Usuarios\UsuarioService;

class UsuarioServiceTest extends TestCase
{
    use RefreshDatabase;

    protected UsuarioService $usuarioService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usuarioService = new UsuarioService();
    }

    public function test_crea_usuario_correctamente()
    {
        $rol = Rol::create([
            'nombre_rol' => 'Administrador'
        ]);

        $data = [
            'Nombre' => 'Ana',
            'P_apellido' => 'López',
            'S_apellido' => 'García',
            'Pass' => 'secret123',
            'Correo' => 'ana@example.com',
            'id_roles' => $rol->id_roles,
            'userState' => true,
        ];

        $usuario = $this->usuarioService->create($data);

        $this->assertDatabaseHas('usuarios', ['Correo' => 'ana@example.com']);
        $this->assertInstanceOf(Usuario::class, $usuario);
        $this->assertTrue(Hash::check('secret123', $usuario->Pass));
    }

    public function test_obtiene_todos_los_usuarios()
    {
        Usuario::factory()->count(3)->create();

        $usuarios = $this->usuarioService->getAll();

        $this->assertCount(3, $usuarios);
    }

    public function test_obtiene_usuario_por_id()
    {
        $usuario = Usuario::factory()->create();

        $encontrado = $this->usuarioService->getById($usuario->idUsuario);

        $this->assertEquals($usuario->Correo, $encontrado->Correo);
    }

    public function test_retorna_null_si_usuario_no_existe()
    {
        $usuario = $this->usuarioService->getById(999);

        $this->assertNull($usuario);
    }

    public function test_actualiza_usuario_correctamente()
    {
        $usuario = Usuario::factory()->create([
            'Nombre' => 'Carlos',
        ]);

        $data = [
            'Nombre' => 'Carlos Actualizado',
        ];

        $actualizado = $this->usuarioService->update($usuario->idUsuario, $data);

        $this->assertEquals('Carlos Actualizado', $actualizado->Nombre);
    }

    public function test_elimina_usuario_correctamente()
    {
        $usuario = Usuario::factory()->create();

        $resultado = $this->usuarioService->delete($usuario->idUsuario);

        $this->assertTrue($resultado);
        $this->assertDatabaseMissing('usuarios', ['idUsuario' => $usuario->idUsuario]);
    }
}
