<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
 
    //este metodo es para establecer un relacion en la que una categoria puede tener muchos productos 
    public function products(){
        return $this->hasMany(Product::class);
    }
}
