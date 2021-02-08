@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hey Blogger :)</title>
  <link rel="stylesheet" href="{{ asset('css/detalle_post/detalle_post.css') }}">
</head>
<body>
  <div class="container col-md-9">
    <div class="titulo-imagen">
      <h1 class="text-monospace font-weight-bold">{{ $detalles->titulo_post }}</h1>
      <div class="portada border-top pt-5">
        <img src="{{ asset('img/posts/'.$detalles->foto) }}" alt="">
      </div>
    </div>
    <section>
      <label>Descripción:</label>
      <p class="my-5">{!! $detalles->descripcion_post !!}</p>
    </section>

    <!-- url()->previous(), nos regresa una vez en el historial, cons js -->
    <!-- <div class="border"> -->
      <a href="{{ url()->previous() }}" class="btn boton-post">Regresar</a>
    <!-- </div> -->
  
  </div>
</body>
</html>

@endsection