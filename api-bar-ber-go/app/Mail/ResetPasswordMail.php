<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $correo;

    /**
     * Crear una nueva instancia del mensaje.
     */
    public function __construct(string $token, string $correo)
    {
        $this->token = $token;
        $this->correo = $correo;
    }

    /**
     * Construir el mensaje.
     */
    public function build()
    {
        return $this->subject('Recuperación de contraseña')
                    ->view('emails.reset-password')
                    ->with([
                        'token' => $this->token,
                        'correo' => $this->correo,
                    ]);
    }
}
