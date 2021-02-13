@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Posts - Registrar</h5>
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

											<!-- usamos laravel collective, accedemos mediante una url a posts -->
											{!! Form::open(['url' => 'posts', 'class' => '', 'files' => true]) !!}

												<label for="">Usuario:</label>
												{!! Form::select('usuario_id', $usuarios, null, 
															[
															 'class'		=> 'form-control',
															 'required'	=> 'required'
															])
												!!}

												<label for="">Categoria:</label>
												{!! Form::select('categoria_id', $categorias, null,
															[
																'class'		 => 'form-control', 
																'required' => 'required'
															]) 
												!!}
												
												<label for="">Titulo:</label>
												{!! Form::text('titulo_post', null, 
															['class'		=> 'form-control',
															 'required' => 'required'
															]) 
												!!}
												
												<label for="">Descripción:</label>
												{!! Form::textarea('descripcion_post', null, 
															[
															 'class'		=> 'form-control', 
															 'required' => 'required'
															]) 
												!!}
												
												<div class="form-group">
													{{ Form::label('etiquetas', 'Etiquetas') }}
													<div>
														@foreach ($etiquetas as $etiqueta)
															<label for="">
																{!! Form::checkbox('etiquetas[]', $etiqueta->id) !!} {!! $etiqueta->nombre_etiqueta !!}
															</label>	
														@endforeach
													</div>
												</div>

												<label for="">Portada</label>
												<input type="file" name="file" class="col-sm-12">


												<div class="text-center mt-3">
													<a href="{{ url('/posts/') }}" class="btn btn-outline-danger">Cancelar</a>
													{!! Form::submit('Registrar', ['class'=>'btn btn-outline-success']) !!}
												</div>

											{!! Form::close() !!}

	                </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@section('summernote')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript">
		// usamos summernote para la descripción del post
		// $(document).ready(function(){
		// 	$('#summernote').summernote();
		// });

		// // usamos summernote para las etiquetas
		// $(document).ready(function() {
		// 	$('#etiquetas').etiquetas();
		// });
		CKEDITOR.replace('descripcion_post');
		// CKEDITOR.config.width = 500;
	</script>

@endsection