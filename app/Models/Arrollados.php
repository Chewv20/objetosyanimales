<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrollados extends Model
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
        'genero',
        'edad',
        'retardo',
        'usuario',
        'usu_correccion',
    ];
}
