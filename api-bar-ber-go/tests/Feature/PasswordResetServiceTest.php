<?php

namespace Tests\Feature;

use App\Mail\ResetPasswordMail;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PasswordResetServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_envia_token_de_recuperacion()
    {
        Mail::fake();

        $usuario = Usuario::factory()->create(['Correo' => 'test@example.com']);

        $response = $this->postJson('/api/forgot-password', [
            'Correo' => 'test@example.com'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Correo de recuperación enviado']);

        Mail::assertSent(ResetPasswordMail::class, function ($mail) use ($usuario) {
            return $mail->hasTo($usuario->Correo);
        });
    }

    public function test_resetea_contrasena_correctamente()
    {
        $usuario = Usuario::factory()->create([
            'Correo' => 'test@example.com',
            'reset_token' => 'token123',
            'reset_expiration' => now()->addMinutes(30),
            'Pass' => Hash::make('oldpass')
        ]);

        $response = $this->postJson('/api/reset-password', [
            'Correo' => 'test@example.com',
            'token' => 'token123',
            'new_password' => 'nuevaClave123',
            'new_password_confirmation' => 'nuevaClave123'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Contraseña actualizada correctamente']);

        $usuario->refresh();
        $this->assertTrue(Hash::check('nuevaClave123', $usuario->Pass));
    }

    public function test_token_expirado_o_invalido()
    {
        $usuario = Usuario::factory()->create([
            'Correo' => 'test@example.com',
            'reset_token' => 'token123',
            'reset_expiration' => now()->subMinutes(1), // token expirado
        ]);

        $response = $this->postJson('/api/reset-password', [
            'Correo' => 'test@example.com',
            'token' => 'token_invalido',
            'new_password' => '12345678',
            'new_password_confirmation' => '12345678'
        ]);

        $response->assertStatus(400)
                 ->assertJson(['message' => 'Token inválido o expirado']);
    }
}
