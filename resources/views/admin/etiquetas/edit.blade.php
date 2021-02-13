@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Etiquetas - Editar</h5>
	                </div>

	               {{--  <div class="card-body">
	                </div> --}}

	                  <div class="card-body">
	                    @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('status') }}
	                        </div>
	                    @endif

	                  	<!-- mostramos las validaciones de errores -->
											@if ($errors->any())
												<div class="alert alert-danger">
													@foreach ($errors->all() as $error)
														<li>{{ $error }}</li>
													@endforeach
												</div>
											@endif

											<!-- model, para rellenar campos ya existentes -->
											{!! Form::model($etiqueta, [
															'url'			=> 'etiquetas/'.$etiqueta->id,
															'method'	=> 'PUT'
											]) !!}

												<label>Nombre:</label>
												<!-- null es el value -->
												{!! Form::text('nombre_etiqueta', null, [
															'class' 		=> 'form-control',
															'required'	=> 'required'
												]) !!}
													
												<div class="text-center mt-3">
													<a href="{{ url('/etiquetas/') }}" class="btn btn-outline-danger">Cancelar</a>
													{!! Form::submit('Registrar', [
														'class'	=> 'btn btn-outline-success'
													]) !!}
												</div>
											{!! Form::close() !!}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection