<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;

    // Tabla asociada (convención Laravel: plural del modelo)
    protected $table = 'coches';

    // Atributos asignables en masa
    protected $fillable = [
        'modelo',
        'unidades',
        'concesionario',
    ];
}