<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistroExitosoUsuario extends Notification
{
    use Queueable;
    protected $usuario;
    protected $contrasena;

    /**
     * Create a new notification instance.
     */
    public function __construct($usuario, $contrasena)
    {
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Registro exitoso - NeuroAr')
            ->view('emails.registro_exitoso', [
                'usuario' => $this->usuario,
                'contrasena' => $this->contrasena,
            ]);
    }

}
