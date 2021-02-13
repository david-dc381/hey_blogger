@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-md-7">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Etiquetas</h5>
	                	<a href="{{ url('etiquetas/create') }}" class="btn btn-success">+ Nuevo</a>
	                </div>

	               {{--  <div class="card-body">
	                </div> --}}

	                  <div class="card-body">
	                    @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('status') }}
	                        </div>
	                    @endif

	                  	<table class="table table-striped table-responsive">
												<thead class="text-white" style="background-color: #6176f3">
													<tr>
														<th scope="col">#</th>
														<th scope="col">Nombre Etiqueta</th>
														<th scope="col">Acciones</th>
													</tr>
												</thead>
												<tbody>
													@foreach($etiquetas as $etiqueta)
														<tr>
															<th scope="row" width="100px">{{ $etiqueta->id }}</th>
															<td width="250px">{{ $etiqueta->nombre_etiqueta }}</td>
															
															<!-- para el boton editar -->
															<td class="d-flex" width="250px">
															<a href="/etiquetas/{{ $etiqueta->id }}/edit" class="btn btn-warning mr-2 ml-2 text-decoration-none text-white">Editar</a>
															<!-- para el boton eliminar, primero obtenemos los datos a eliminar -->
															{!! Form::open([
																	'url'				=> 'etiquetas/'.$etiqueta->id,
																	'method'		=> 'DELETE', 
																	'onsubmit'	=> 'return confirm("¿Está seguro que desea eliminar la etiqueta?")'
															]) !!}
																	<!-- boton de eliminar -->
																	{!! Form::submit('Eliminar', ['class'=>'btn btn-danger ml-2 mr-2']) !!}

															{!! Form::close() !!}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
											{{ $etiquetas->links() }}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection