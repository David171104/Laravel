<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GuzzleHttp\Client;
use Illuminate\Notifications\ChannelManager;

use App\Notifications\Channels\HablameChannel;

class CodigoRecuperacionNotification extends Notification
{
    use Queueable;

    protected $verificationCode;

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    public function via($notifiable)
    {
        return [HablameChannel::class];
    }

    public function toHablame($notifiable)
    {
        // Aquí debes definir el contenido del mensaje que deseas enviar
        return "Hola {$notifiable->name}, gracias por registrarte en nuestra aplicación. Tu código de verificación es {$this->verificationCode}.";
    }
}