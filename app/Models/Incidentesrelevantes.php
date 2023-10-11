<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidentesrelevantes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fecha',
        'linea',
        'lugar',
        'evento',
        'usuario',
        'usu_correccion',
    ];
}
