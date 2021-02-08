<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';
    protected $fillable = [
        'descripcion_comentario',
        'usuario_id',
        'post_id',
    ];

    // un comentario pertenece a un post
    public function post() {
        return $this->belongsTo('App\Models\Post');
    }
    // un comentario pertenece a un usuario
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    // use HasFactory;
}
