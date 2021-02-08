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
											{!! Form::model($user, [
															'url'			=> 'usuarios/'.$user->id,
															'method'	=> 'PUT',
															'files'		=> 'true',
											]) !!}

												<label for="">Nombre:</label>
												{!! Form::text('nombre', null, 
															[
															 'class'		=> 'form-control',
															 'required'	=> 'required'
															])
												!!}

												<label for="">Nombre de usuario:</label>
												{!! Form::text('nombre_usuario', null,
															[
																'class'		 => 'form-control', 
																'required' => 'required'
															]) 
												!!}
												
												<label for="">email:</label>
												{!! Form::email('email', null, 
															['class'		=> 'form-control',
															 'required' => 'required'
															]) 
												!!}
												
												<label for="">Contraseña:</label>
												{!! Form::password('password', null, 
															['class'		=> 'form-control', 
															 'required' => 'required'
															]) 
												!!}
												
												<label for="">Rol:</label>
												{!! Form::select('rol_id', $roles, null, 
															['class'		=> 'form-control', 
															 'required' => 'required'
															]) 
												!!}
												
												<label for="">Foto de pérfil:</label>
												@if( $user->foto != '' )
													{!! Form::file('file', null, 
																['class'		=> 'form-control-file', 
																'required'=>'required'
																]) 
													!!}
												@endif

												<div class="text-center mt-3">
													{!! Form::submit('Editar', ['class'=>'btn btn-outline-success']) !!}
												</div>

											{!! Form::close() !!}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection