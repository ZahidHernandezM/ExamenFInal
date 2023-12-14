<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombre',
        'descripcion' ,
        'precio_unitario' ,
        'cantidad',
        'costo_total' ,

    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
