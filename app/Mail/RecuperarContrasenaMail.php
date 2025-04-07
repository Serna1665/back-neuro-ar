<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecuperarContrasenaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $usuarios;
    public $token;

    public function __construct($usuarios, $token)
    {
        $this->usuarios = $usuarios;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Recuperación de contraseña')
            ->view('emails.recuperar-contrasena');
    }
}
