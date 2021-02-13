@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- vista de usuario a mostrar -->
        <div class="col-lg-9 col-md-8 col-12">
            <!-- Card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!--mostramos las validaciones de errores -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h3 class="mb-0">Detalles de Pérfil</h3>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-4 mb-lg-0">                            
                            @if($user->foto != '')
                                <img src="{{ asset('img/usuarios/'.$user->foto) }}" width="80px" height="80px" id="img-uploaded" class="avatar-xl rounded-circle" alt="Foto de pérfil">
                            @else
                                <img src="{{ asset('img/perfil_default.svg') }}" width="80px" height="80px" id="img-uploaded" class="avatar-xl rounded-circle" alt="Foto de pérfil por defecto">
                            @endif
                            <div class="ml-3">
                                <h4 class="mb-0">Tu foto de pérfil</h4>
                                <p class="mb-0">
                                    {{ $user->nombre }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5">
                    <div>
                        <h4 class="mb-0">Detalles Personales</h4>
                        <p class="mb-4">
                            Edite su información personal.
                        </p>

                        <!-- Form -->
                        {!! Form::model($user, ['url' => 'update_profile/', 'method' => 'PUT', 'files' => 'true', 'class'=>'form-row']) !!}
                            <div class="form-group col-12 col-md-6">
                                {!! Form::label('nombre', 'Nombre', ['class' => 'form-label']) !!}
                                {!! Form::text('nombre', null, ['id'=>'nombre', 'class'=>'form-control', 'required'=>'required', 'placeholder'=>'Nombre']) !!}
                            </div>
                            <div class="form-group col-12 col-md-6">
                                {!! Form::label('nombre_usuario', 'Nombre de usuario', ['class' => 'form-label']) !!}
                                {!! Form::text('nombre_usuario', null, ['id'=>'nombre_usuario', 'class'=>'form-control', 'required'=>'required', 'placeholder'=>'Nombre de usuario']) !!}
                            </div>
                            <div class="form-group col-12 col-md-6">
                                {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                                {!! Form::email('email', null, ['id'=>'email', 'class'=>'form-control', 'required'=>'required', 'placeholder'=>'Email']) !!}
                            </div>
                            <div class="form-group col-12 col-md-6">
                                {!! Form::label('password', 'Contraseña', ['class' => 'form-label']) !!}
                                <!-- {!! Form::password( null, ['id'=>'password', 'class'=>'form-control', 'placeholder'=>'Nueva contraseña']) !!} -->
                                <input type="password" name="password" class="form-control" placeholder="Nueva contraseña">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                {!! Form::label('foto', 'Foto de pérfil', ['class' => 'form-label']) !!}
                                <input type="file" name="file" class="form-control-file">
                            </div>
                            <div class="col-12">
                                {!! Form::submit('Actualizar', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
