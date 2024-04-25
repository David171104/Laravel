<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // Una clase que nos permite crear o hacer pruebas de datos
    protected $fillable = [
        'name', 'pdf',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Aquí irían las relaciones, métodos personalizados, etc.
    public function getStatusNameAttribute(): string
    {
        if ($this->status == 1) {
            return 'Available';
        }

        return 'Sold';
    }
}
