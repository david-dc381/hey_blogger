<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Etiqueta;
use App\Models\Helper;
use App\Models\PostEtiqueta;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index(Request $request)
    {
        // con compact hacemos que $posts se convierta en la clave y
        // el contenido de $posts se convierta en el valor de esa clave
        
        if ($request) {
            $query = trim($request->get('search'));

            // $posts = Post::paginate(6);
            
            if ($query != '') {
                // $posts = Post::orderBy('id');
                $posts = Post::where('titulo_post', 'LIKE', '%'.$query.'%')
                ->orderBy('id', 'ASC') // mostramos los datos por su id de manera descendente
                ->paginate(6); //le indicamos que nos muestre la paginación de 6 en 6 productos.        
                return view('admin/posts.index', compact('posts', 'query')); // junto a la vista mostramos los datos.
                
            } else {
                $posts = Post::orderBy('id', 'ASC')
                ->paginate(6);
                return view('admin/posts.index', compact('posts')); // junto a la vista mostramos los datos.
            }
                
        }
    }

    public function buscador(Request $request) {
        $postsBuscar = Post::where('titulo_post', 'like', '%'. $request->get('searchQuest').'%')->get();
        return json_encode($postsBuscar);
    }


    public function create()
    {
        // traemos los datos antes de registrarlos
        $etiquetas  = Etiqueta::orderBy('id', 'ASC')->get();
        $categorias = Categoria::orderBy('id', 'ASC')->pluck('nombre_categoria', 'id');
        $usuarios   = User::orderBy('id', 'ASC')->pluck('nombre', 'id');

        return view('admin/posts.create', compact('etiquetas', 'categorias', 'usuarios'));
    }


    public function store(Request $request)
    {
        // almacenamos los datos traidos de arriba
        $request->validate([
            'titulo_post'      => 'required',
            'descripcion_post' => 'required',
            'categoria_id'     => 'required',
            'file'             => 'image|max:3000',
            'etiquetas'        => 'array',  // un array para las muchas etiquetas (muchos a muchos)
        ]);

        // verificamos si el usuario es el admin o no
        $user = Auth::user();
        if ($user->rol->nombre_rol != 'administrador') {
            $request['user_id'] = $user->id;
        }

        // para registrar la img
        // verificamos si existe una foto que se haya mandado desde el form.
        if ($request->file) {
            // request trae los valores del formulario, sus parámetros
            $name = Helper::saveImage($request->file, 'posts'); // qqui le pasamos el cmpo de foto y creamos la carpeta de fotos.
            // el campo foto lo reemplazamos por el campo de $name que le estamos pasando, esta es más para asignación.
            // Aquí se queda con el nombre de foto, no le afecta file a foto porque en el modelo no esta definido file.
            $request['foto'] = $name;
        }

        $post = Post::create($request->all());

        // verificamos si etiquetas existen y hacemos un registro, esto es de muchos a muchos
        if ($request->etiquetas) {
            foreach ($request->etiquetas as $etiqueta_form) {
                $post_etiqueta = PostEtiqueta::create([
                    'post_id'     => $post->id,
                    'etiqueta_id' => $etiqueta_form,
                ]);
            }
        }

        return redirect('/posts');
    }


    public function show($id)
    {
      

    }


    public function edit($id)
    {
         // obtenemos los datos de la vista para editar
        $etiquetas = Etiqueta::orderBy('nombre_etiqueta', 'Asc')->get();
        $categorias = Categoria::orderBy('nombre_categoria', 'Asc')->pluck('nombre_categoria', 'id');
        $usuarios = User::orderBy('nombre', 'Asc')->pluck('nombre', 'id');

        $post = Post::find($id);

        // mostramos todas las etiquetas que tiene el post
        $etiquetas_array = PostEtiqueta::where('post_id', $post->id)->pluck('etiqueta_id')->toArray();


        return view('admin/posts.edit', compact('etiquetas', 'categorias', 'usuarios', 'post', 'etiquetas_array'));
    }


    public function update(Request $request, $id)
    {
       $request->validate([
            'titulo_post'      => 'required',
            'descripcion_post' => 'required',
            'categoria_id'     => 'required',
            'file'             => 'image|max:3000',
            'etiquetas'        => 'array',  // un array para las muchas etiquetas (muchos a muchos)
        ]);

        $post = Post::find($id);
        $user = Auth::user();

        // verificamos el tipo de usuario
        if ($user->rol->nombre_rol != 'administrador') {
            $request['user_id'] = $user->id;
        }

        // para la foto
        if ($request->file) {
            // buscca la foto del usuario, en la carpeta users y la elimina
            Helper::deleteImage($user->foto, 'posts');
            // registramos la nueva foto
            $name = Helper::saveImage($request->file, 'posts');
            $request['foto'] = $name;
            
        } else { // si no actualizamos la foto, que se quede con la que tenia.
            $request['foto'] = $post->foto;
        }

        // primero guardamos los posts
        $post->fill($request->all());
        $post->save();

        // nos pasa el id de las etiquetas y lo elimina, en caso que ya
        // no queramos una etiqueta al editarlo
        PostEtiqueta::where('post_id', $post->id)->delete();

        // de muchos a muchos, aqui registramos las etiquetas que queramos aumentar
        if ($request->etiquetas) {
            foreach ($request->etiquetas as $etiqueta_form) {
                $post_etiqueta = PostEtiqueta::create([
                    'post_id'     => $post->id,
                    'etiqueta_id' => $etiqueta_form,
                ]);
            }
        }

        return redirect('posts');
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            Helper::deleteImage($post->foto, 'posts');
            $post->delete();
        }
        return redirect('/posts');
    }
}
