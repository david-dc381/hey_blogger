@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Posts</h5>
	                	<a href="{{ url('/posts/create') }}" class="btn btn-success">+ Nuevo</a>
	                </div>

	               {{--  <div class="card-body">
	                </div> --}}

	                  <div class="card-body">
	                    @if (session('status'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('status') }}
	                        </div>
	                    @endif

	                  	<table class="table table-striped table-responsive pl-4 pr-4">
												<thead class="text-white" style="background-color: #6176f3">
													<tr>
														<th scope="col">#</th>
														<th scope="col">Título</th>
														<th scope="col">Usuario</th>
														<th scope="col">Categoria</th>
														<th scope="col">Portada</th>
														<th scope="col">Acciones</th>
													</tr>
												</thead>
												<tbody>
													@foreach($posts as $post)
														<tr>
															<td>{{ $post->id }}</td>
															<td>{{ $post->titulo_post }}</td>
															<td>{{ $post->usuario->nombre }}</td>
															<td>{{ $post->categoria->nombre_categoria }}</td>
															<td>
																@if($post->foto != '')
																	<img src="{{ asset('img/posts/'.$post->foto) }}" alt="Portada de Post" width="75px">
																@endif
															</td>
															<td class="d-flex">
																<button type="button" class="btn btn-warning mr-2 ml-2">
																	<a href="/posts/{{ $post->id }}/edit" class="text-decoration-none text-dark">Editar</a>
																</button>
																{!! Form::open([
																	'url'			 => 'posts/'.$post->id,
																	'method'	 => 'DELETE',
																	'onsubmit' =>	'return confirm("¿Está seguro de eliminar el post?")'
																]) !!}

																{!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}

																{!! Form::close() !!}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
											{{ $posts->links('vendor.pagination.bootstrap-4') }}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection