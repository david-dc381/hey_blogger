<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Etiqueta;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etiquetas = Etiqueta::orderBy('id', 'ASC')->paginate(6);
        return view('admin/etiquetas.index', compact('etiquetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/etiquetas.create');
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
            'nombre_etiqueta' => 'required|
                        unique:etiquetas,nombre_etiqueta',
        ]);
        $etiqueta = Etiqueta::create($request->all());
        return redirect('etiquetas');
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
        $etiqueta = Etiqueta::find($id);
        return view('admin/etiquetas.edit', compact('etiqueta'));
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
        $etiqueta = Etiqueta::find($id);
        $request->validate([
            'nombre_etiqueta' => 'required|
                        unique:etiquetas,nombre_etiqueta,'.$etiqueta->nombre_etiqueta.',nombre_etiqueta',
        ]);
        // agarra todos los campos y empareja todos lo objs y los reemplaza.
        $etiqueta->fill($request->all());
        $etiqueta->save();

        return redirect('/etiquetas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etiqueta = Etiqueta::find($id);

        if ($etiqueta) {
            $etiqueta->delete();
        }
        return redirect('/etiquetas');
    }
}
