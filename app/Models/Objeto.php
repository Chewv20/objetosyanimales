<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objeto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'linea',
        'fecha',
        'estacion',
        'retardo',
        'corte_corriente',
    ];
}
