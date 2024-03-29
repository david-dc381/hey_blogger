<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'nombre_usuario',
        'email',
        'password',
        'foto',
        'rol_id',
    ];

    // un usuario tiene muchos comentarios
    public function comentarios() {
        return $this->hasMany('App\Models\Comentario');
    }
    // un usuario tiene muchos posts
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
    // un usuario solo tiene un rol en el sistema
    public function rol() {
        return $this->belongsTo('App\Models\Rol');
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
