<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    protected $fillable = [
        'nombre_categoria',
    ];

    // una categoria tiene muchos posts
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    // use HasFactory;
}
