<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_correcto()
    {
        $usuario = Usuario::factory()->create([
            'Correo' => 'test@example.com',
            'Pass' => Hash::make('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'Correo' => 'test@example.com',
            'Pass' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['access_token', 'token_type', 'user']);
    }

    public function test_login_incorrecto()
    {
        $response = $this->postJson('/api/login', [
            'Correo' => 'wrong@example.com',
            'Pass' => 'wrongpass'
        ]);

        $response->assertStatus(401)
                 ->assertJson(['message' => 'Correo o contraseña incorrectos']);
    }

    public function test_logout_correcto()
    {
        $usuario = Usuario::factory()->create();
        $token = $usuario->createToken('auth_token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Sesión cerrada correctamente']);
    }
}
