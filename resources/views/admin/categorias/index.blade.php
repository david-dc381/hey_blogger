@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-md-7">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Categorias</h5>
	                	<a href="{{ url('categorias/create') }}" class="btn btn-success">+ Nuevo</a>
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
														<th scope="col">Nombre Categoria</th>
														<th scope="col">Acciones</th>
													</tr>
												</thead>
												<tbody>
													@foreach($categorias as $categoria)
														<tr>
															<th scope="row" width="100px">{{ $categoria->id }}</th>
															<td width="250px">{{ $categoria->nombre_categoria }}</td>
															
															<!-- para el boton editar -->
															<td class="d-flex" width="250px">
																<button class="btn btn-sm btn-warning ml-2 mr-2">
																	<a href="/categorias/{{ $categoria->id }}/edit" class="text-decoration-none text-dark">Editar</a>
																</button>
															<!-- para el boton eliminar, primero obtenemos los datos a eliminar -->
															{!! Form::open([
																	'url'				=> 'categorias/'.$categoria->id,
																	'method'		=> 'DELETE', 
																	'onsubmit'	=> 'return confirm("¿Está seguro que desea eliminar la categoria?")'
															]) !!}
																	<!-- boton de eliminar -->
																	{!! Form::submit('Eliminar', ['class'=>'btn btn-danger ml-2 mr-2']) !!}

															{!! Form::close() !!}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
											{{ $categorias->links() }}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection