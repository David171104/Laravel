<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\RoutesNotifications;

class Usuarios extends Model
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'telefono', //  asignar en masa propiedades que no están permitidas en el modelo. Esto es una medida de seguridad para evitar la asignación masiva no deseada de datos sensibles.
    ];

    public function routeNotificationForVonage()
    {
        // Debe devolver el número de teléfono al que se enviarán las notificaciones de Vonage
        return $this->telefono;
    }
}
