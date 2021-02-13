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
		'foto',
		'usuario_id',
		'categoria_id',
	];
		// use HasFactory;
	
	// un post tiene solo una categoria
	public function categoria() {
		return $this->belongsTo('App\Models\Categoria');
	}
	// un post tiene muchos comentarios
	public function comentarios() {
		return $this->hasMany('App\Models\Comentario');
	}
	// un post tiene un usuario
	public function usuario() {
		return $this->belongsTo('App\Models\User');
	}
	// un post tiene muchas etiquetas
	public function posts_etiquetas() {
		return $this->hasMany('App\Models\PostEtiqueta');
	}
	
	
	
	
	// Agreagamos esto para la busqueda de posts en el welcome
	public function scopeName ($query, $nombre_post) {
		if($nombre_post) {
			return 	$query->where('titulo_post', 'LIKE', "%$nombre_post%");
		}
	}
}


