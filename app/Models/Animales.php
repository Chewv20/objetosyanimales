<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animales extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha',
        'linea',
        'hora',
        'estacion',
        'descripcion',
        'status',
        'retardo',
        'usuario',
        'usu_correccion',
    ];
}
