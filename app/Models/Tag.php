<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'etiquetas';
    protected $fillable = [
        'nombre_etiqueta',
    ];
    // use HasFactory;
}
