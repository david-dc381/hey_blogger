@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Categoria - Registrar</h5>
	                </div>

	               {{--  <div class="card-body">
	                </div> --}}

	                  <div class="card-body">
	                    @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('status') }}
	                        </div>
	                    @endif

											<!-- hacemos un bucle para todos los errores que aparescan -->
											@if ($errors->any()) <!-- si hay algun error, entonces: -->
												<div class="alert alert-danger">
													<ul>
														@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
														@endforeach
													</ul>
												</div>
											@endif

											<!-- usamos laravel collective, accedemos mediante una url a categorias -->
											{!! Form::open(['url' => 'categorias', 'class' => '']) !!}

												<label for="">Nombre:</label>
												<!-- mostramos los campos registrados -->
												{!! Form::text('nombre_categoria', null, ['class'=>'form-control', 'required'=>'required']) !!}

												<div class="text-center mt-3">
													{!! Form::submit('Registrar', ['class'=>'btn btn-outline-success']) !!}
												</div>

											{!! Form::close() !!}

	                </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection