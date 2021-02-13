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
    public function welcome(Request $request)
    {
        // para la busqueda de posts, esto esta vinculado al modelo Post.php
        // $nombre_post = $request->get('titulo_post');
        // ->titulo_post($nombre_post)

        if ($request) {
            $query = trim($request->get('search'));
            
            $posts2 = Post::orderBy('id');
            $posts2 = Post::where('titulo_post', 'LIKE', '%'.$query.'%')
            ->orderBy('id', 'ASC')
            ->paginate(6); //le indicamos que nos muestre la paginación de 6 en 6 productos.
            // ->get();
            

             return view('welcome', compact('posts2', 'query')); //listado de productos
        }

        // $posts2 = Post::paginate(6);
        // return view('welcome', compact('posts2')); 
        
    }

    public function buscador(Request $request)
    {
        // if($request->ajax()) {
        //     $output = '';
        //     $query = $request->get('query');
        //     if ($query != '') {
        //         $data = DB::table('posts')
        //         ->where('titulo_post', 'like', '%'.$query.'%')
        //         ->orderBy('id', 'ASC')
        //         ->paginate(6);
        //     } else {
        //         $data = DB::table('posts')
        //         ->orderBy('id', 'ASC')
        //         ->paginate(6);
        //     }

        //     // $total_filas = $data->count;
        //     // if ($total_filas === 0) {
        //     //     $output = '<tr>
        //     //         <td align="center" colspan="5" class="text-white">No se encontraron</td>
        //     //     </tr>';
        //     // }

        //     $data = array(
        //         'table_data' => $output,
        //     );

        //     echo json_encode($data);
        // }


        

        // $postsBuscar = Post::where('titulo_post', 'like', '%'. $request->get('searchQuest').'%')->get();
        
        // return json_encode($postsBuscar);
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
