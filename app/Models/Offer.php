<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'tipo_oferta', 'codigo_cupon', 'cadena', 'provincia', 'fecha_inicio', 'fecha_fin', 'precio_original', 'precio_descuento', 'enlace', 'usuario'
    ];
}