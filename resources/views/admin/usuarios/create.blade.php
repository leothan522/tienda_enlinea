@extends("layouts.admin.layout")
@section('title', 'Usuarios')
@section('usuarios', 'active')
@section('container-title', 'Usuarios')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios Registrados</a></li>
    <li class="breadcrumb-item active">Nuevo Usuario</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">



            <!-- general form elements -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'usuarios.store', 'method' => 'POST', 'role' => 'form']) !!}
                    <div class="card-body">

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Name'), 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                {!! Form::email('email', null, ['class'=> 'form-control', 'placeholder' => __('E-Mail Address'), 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                {!! Form::text('password', $clave, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo de Usuario</label>
                                {!! Form::select('type', ['Miembro' => 'Miembro', 'Administrador' => 'Administrador'], null,
                                                    ['class' => 'form-control']) !!}
                            </div>
                            {{--<div class="form-group">
                                <label for="exampleInputFile">Imagen de Perfil</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
                            </div>--}}
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-right">
                        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->




        </div>
    </div>
@endsection

@section('script')

@endsection


