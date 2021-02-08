<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'nombre_rol',
        'puntos',
    ];

    // un rol tiene muchos usuarios
    public function users() {
        return $this->hasMany('App\User');
    }
    // use HasFactory;
}
