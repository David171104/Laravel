<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Iluminate\Support\Facades\Mail;
use App\Http\Controllers\UserController;
use SplSubject;
use App\Mail\Content;
use App\Mail\Envelope;





class EnviarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $correo;
    public $codigoRecuperacion;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $codigoRecuperacion)
    {
        $this->codigoRecuperacion = $codigoRecuperacion;
        $this->correo = $correo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Código de recuperación de contraseña')
            ->view('mail.enviar-correo')
            ->with([
                'correo' => $this->correo,
                'codigoRecuperacion' => $this->codigoRecuperacion,
            ]);
    }
}
