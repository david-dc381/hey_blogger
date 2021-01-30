<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'posts_etiquetas';
    protected $fillable = [
        'post_id',
        'etiqueta_id',
    ];

    // una etiqueta tiene muchos posts 
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
    // un post tiene muchas etiquetas
    public function tags() {
        return $this->hasMany('App\Models\Post');
    }
    // use HasFactory;
}
