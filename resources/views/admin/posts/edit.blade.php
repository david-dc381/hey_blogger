@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Posts - Editar</h5>
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
											{!! Form::model($post, [
															'url'			=> 'posts/'.$post->id,
															'method'	=> 'PUT',
															'files'		=> 'true',
											]) !!}

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
															['class'		=> 'form-control', 
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

												<label for="">Portada:</label>
												@if($post->foto != '')
													<div class="form-group">
														<img src="{{ asset('img/posts/'.$post->foto) }}" alt="foto portada" width="150px" class="mt-3">
													</div>
												@endif
												<input type="file" name="file" class="col-sm-12">
												<!-- {!! Form::file('file', null, 
															['class'		 => 'from-group col-sm-12',
																'required' => 'required',
															]);
												!!} -->

												<div class="text-center mt-3">
													<a href="{{ url('/posts/') }}" class="btn btn-outline-danger">Cancelar</a>
													{!! Form::submit('Actualizar', ['class'=>'btn btn-outline-success']) !!}
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

<!-- <script>
	$(document).ready(function() {
	$('#etiqueta').multiselect();
	});
</script> -->

@endsection