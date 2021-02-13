@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hey Blogger :)</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow:wght@600;700&family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/detalle_post/detalle_post.css') }}">
</head>
<body>
  <div class="container col-md-9 rounded-lg">
    <div class="titulo-imagen">
      <h1 class="col-lg-11 pb-3 font-weight-bold border-bottom mx-auto">{{ $detalles->titulo_post }}</h1>
      <div class="portada pt-4">
        <img src="{{ asset('img/posts/'.$detalles->foto) }}" class="rounded-sm" alt="portada">
      </div>
    </div>
    
      <div class="card card-default descripcion_post mt-2 mb-3">
        <div class="card-body col-lg-12">
          <p> {!! $detalles->descripcion_post !!} </p>
        </div>
      </div>

    <!-- url()->previous(), nos regresa una vez en el historial, cons js -->
    <div class="container_boton">
      <a href="{{ url()->previous() }}" class="btn boton-post">Regresar</a>
    </div>

  </div>
</body>
</html>

@endsection