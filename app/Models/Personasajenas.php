<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personasajenas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha',
        'linea',
        'hora',
        'estacion',
        'descripcion',
        'genero',
        'edad',
        'retardo',
        'usuario',
        'usu_correccion',
    ];
}
