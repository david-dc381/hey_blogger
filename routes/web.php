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

Auth::routes();
// rutas clásicas
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuarios',      'Admin\\UserController');
Route::resource('posts',      'Admin\\PostController');
Route::resource('categorias', 'Admin\\CategoriaController');
Route::resource('etiquetas',  'Admin\\EtiquetaController');
Route::resource('roles',  'Admin\\RolController');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
