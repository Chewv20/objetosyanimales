<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zapatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'linea',
        'fecha',
        'hora',
        'descripcion',
        'humo',
        'usuario',
        'usu_correccion',
    ];
}
