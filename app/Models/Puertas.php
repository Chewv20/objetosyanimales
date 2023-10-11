<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puertas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha',
        'hora',
        'linea',
        'estacion',
        'descripcion',
        'puerta_opuesta',
        'desalojo',
        'asistencia_policia',
        'usuario',
        'usu_correccion',
    ];
}
