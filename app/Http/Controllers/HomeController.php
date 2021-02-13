<?php

namespace App\Http\Controllers;

use App\Models\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
    }

    // función para actualizar el pérfil
    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'nombre'         => 'required|max:50',
            'nombre_usuario' => 'required|max:20|unique:users,nombre_usuario,'.$user->nombre_usuario.',nombre_usuario',
            'email'          => 'required|email|unique:users,email,'.$user->email.',email',
            'file'           => 'image|max:3000',
        ]);

        // aqui solo vamos a agarrar los campos que necesitemos y no usaremos fill(), que agarra todo
        // reemplazamos los nuevos valores
        $user->nombre         = $request->nombre;
        $user->nombre_usuario = $request->nombre_usuario;
        $user->email          = $request->email;
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
        return redirect('/home');
    }
}
