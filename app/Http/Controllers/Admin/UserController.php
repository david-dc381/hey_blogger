<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Rol;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'ASC')->paginate(6);
        return view('admin/usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::orderBy('nombre_rol', 'ASC')->pluck('nombre_rol', 'id');
        return view('admin/usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'         => 'required|max:50',
            'nombre_usuario' => 'required|max:20',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|',
            'file'           => 'image|max:3000',
            'rol_id'         => 'required',
        ]);
        // encriptamos la contraseña
        $request['password'] = bcrypt($request->password);
        
        // código para la foto
        if ($request->file) {
            // usamos el Helper que hace que se crea la carpeta de las fotos.
            $name = Helper::saveImage($request->file, 'usuarios');
            $request['foto'] = $name; // $name, su ruta pasa al campo foto
        }
        $user = User::create($request->all());
        return redirect('/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Rol::orderBy('nombre_rol', 'ASC')->pluck('nombre_rol', 'id');
        $user  = User::find($id);

        return view('admin/usuarios.edit', compact('roles', 'user'));
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
        $user = User::find($id);
        $request->validate([
            'nombre'         => 'required|max:50',
            'nombre_usuario' => 'required|max:20',
            'email'          => 'required|email|unique:users,email,'.$user->email.',email',
            'file'           => 'image|max:3000',
            'rol_id'         => 'required',
        ]);

        // aqui solo vamos a agarrar los campos que necesitemos y no usaremos fill(), que agarra todo
        // reemplazamos los nuevos valores
        $user->nombre         = $request->nombre;
        $user->nombre_usuario = $request->nombre_usuario;
        $user->email          = $request->email;
        $user->rol_id         = $request->rol_id;
        // código para actualizar la foto si es necesario
        if ($request->file) {
            Helper::deleteImage($user->foto, 'usuarios');
            $name = Helper::saveImage($request->file, 'usuarios');
            $request['foto'] = $name;
        
        } else {
            $request['foto'] = $user->foto;
        }

        // Revisamos el password
        if ($request->password) { // si hay una peticion de password
            // registramos un nuevo password en el campo password encriptandolo
            $request['password'] = bcrypt($request->password);
        
        } else {
            // si no se mantiene el password que teniamos
            $request['password'] = $user->password;
        }
        $user->fill($request->all());
        $user->save();
        return redirect('/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            // eliminamos la img de la carpeta
            Helper::deleteImage($user->foto, 'usuarios');
            // eliminamos el usuario
            $user->delete();
        }
        return redirect('/usuarios');
        
    }
}
