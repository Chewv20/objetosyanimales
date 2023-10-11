<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estaciones2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_estacion',
        'linea',
        'estacion',
    ];
}
