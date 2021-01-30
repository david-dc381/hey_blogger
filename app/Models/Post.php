<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $table = 'posts';
	protected $fillable = [
		'titulo_post',
		'descripcion_post',
		'usuario_id',
		'categoria_id',
	];
		// use HasFactory;
	
	// un post tiene solo una categoria
	public function category() {
		return $this->belongsTo('App\Models\Category');
	}
	// un post tiene muchos comentarios
	public function comments() {
		return $this->hasMany('App\Models\Comment');
	}
	// un post tiene un usuario
	public function user() {
		return $this->belongsTo('App\Models\User');
	}
	// un post tiene muchas etiquetas
	public function posts_taga() {
		return $this->hasMany('App\PostTag');
	}
}
