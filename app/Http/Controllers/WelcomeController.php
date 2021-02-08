<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Categoria;
use App\Models\PostEtiqueta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $posts2 = Post::paginate(6); //le indicamos que nos muestre la paginación de 6 en 6 productos.
        return view('welcome', compact('posts2')); //listado de productos
        
        // $posts2 = Post::all();
        // return view('welcome')->with(compact('posts2', 'paginate')); 
    }


    // para ver los detalles del post
    public function detalle($id) {
        $categorias = Categoria::orderBy('nombre_categoria')->pluck('nombre_categoria', 'id');
        $user      = User::orderBy('nombre_usuario')->pluck('nombre_usuario', 'id');
        $detalles   = Post::find($id);
        $etiquetas_array = PostEtiqueta::where('post_id', $detalles->id)->pluck('etiqueta_id')->toArray();

        return view('detalle_post', compact('categorias', 'user', 'detalles', 'etiquetas_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
