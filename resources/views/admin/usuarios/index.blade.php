@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
	        <div class="col-lg-10">
	            <div class="card">
	                <div class="card-header d-flex justify-content-between align-items-center" ><h5 class="mt-1">Usuarios</h5>
	                	<a href="{{ url('usuarios/create') }}" class="btn btn-success">+ Nuevo</a>
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
														<th scope="col">Nombre</th>
														<th scope="col">Nombre de Usuario</th>
														<th scope="col">Email</th>
														<th scope="col">Rol de usuario</th>
														<th scope="col">Foto de pérfil</th>
														<th scope="col">Acciones</th>
													</tr>
												</thead>
												<tbody>
													@foreach($users as $user)
														<tr>
															<th scope="row">{{ $user->id }}</th>
															<th>{{ $user->nombre }}</th>
															<td>{{ $user->nombre_usuario }}</td>
															<td>{{ $user->email }}</td>
															<td>{{ $user->rol->nombre_rol }}</td>
															<td>
																@if($user->foto != '')
																	<img src="{{ asset('img/usuarios/'.$user->foto) }}" width="50px" height="50px" class="d-block m-auto" alt="Foto de perfil de usuario">
																	@else 
																	<img src="{{ asset('img/perfil_default.svg') }}" width="50px" height="50px" class="d-block m-auto" alt="Foto de perfil de usuario">
																@endif
															</td>
															<td class="d-flex">
																<a href="/usuarios/{{ $user->id }}/edit" class="btn btn-warning mr-2 ml-2 text-decoration-none text-white">
																	Editar
																</a>

																{!! Form::open(
																	['url'			=> 'usuarios/'.$user->id,
																	 'method'		=> 'DELETE',
																	 'onsubmit'	=> 'return confirm("¿Está seguro de eliminar el usuario?")'
																	]
																) !!}

																	{!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}																		
																
																{!! Form::close() !!}
															</td>
														</tr>
													@endforeach
												</tbody>
											</table>
											{{ $users->links() }}
	                </div>
	            </div>
	        </div>
	    </div>
	</div>


@endsection