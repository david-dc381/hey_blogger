<?php

use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ruta para obtener los posts en la vista welcome
Route::get('/', 'WelcomeController@welcome');
// ruta para obtener el post especifico
Route::get('/detalle_post/{id}', 'WelcomeController@detalle');

# Indicamos con esto que estas rutas son protegidas para el administrador 
Auth::routes();

# rutas clásicas, antes de laravel 8

// Ruta para elmostrar el inicio de la página al loguearte 
Route::get('/home', 'HomeController@index')->name('home');
// Ruta para las busquedas
Route::post('/posts/buscador', ['as'=>'search-posts', 'uses' =>
'WelcomeController@buscador']);

// Ruta para mostrar en el home el usuario logeado y actualizarlo
Route::put('/update_profile', 'HomeController@update_profile');


# Con middleware controlamos las autenticaiones, a donde solo el admin puede ingresar
Route::middleware(['auth'])->group(function() {
    Route::resource('usuarios',      'Admin\\UserController');
    Route::resource('posts',      'Admin\\PostController');
    Route::resource('categorias', 'Admin\\CategoriaController');
    Route::resource('etiquetas',  'Admin\\EtiquetaController');
    Route::resource('roles',  'Admin\\RolController');
});


// Route::get('/posts/buscador', 'WelcomeController@buscador')->name('posts.buscador');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
