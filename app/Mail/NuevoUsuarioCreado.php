<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevoUsuarioCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;

    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject("Nuevo usuario creado: {$this->usuario->name}")
                    ->view('emails.nuevo_usuario')
                    ->with([
                        'usuario' => $this->usuario,
                    ]);
    }
}