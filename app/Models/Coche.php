<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;

    protected $table = 'coche';

    public $timestamps = false;

    protected $fillable = [
        'modelo',
        'unidades',
        'concesionario'
    ];
}