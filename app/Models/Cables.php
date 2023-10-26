<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cables extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha',
        'linea',
        'hora',
        'estacion',
        'descripcion',
        'ubicacion',
        'metrosrobados',
        'usuario',
        'usu_correccion',
    ];
}
