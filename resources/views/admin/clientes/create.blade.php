@extends("layouts.admin.layout")
@section('title', 'Clientes | Nuevo')
@section('clientes', 'active')
@section('container-title', 'Clientes')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('clientes.index') }}">Clientes Registrados</a></li>
    <li class="breadcrumb-item active">Nuevo Cliente</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            {!! Form::open(['route' => 'clientes.store', 'method' => 'POST']) !!}

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos Personales</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Cedula</label>
                                {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'V-12345678',
                                                'data-inputmask' => '"mask": "A-99999999"', 'data-mask', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                {!! Form::text('nombre_completo', null, ['class' => 'form-control', 'placeholder' => 'Nombre Completo',
                                                'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Numero',
                                                    'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Direccion</label>
                                {!! Form::textarea('direccion', null, ['class' => 'form-control', 'placeholder' => 'Direccion: ',
                                                                    'cols' => 30, 'rows' => 2, 'required']) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">
                    {{--<input type="hidden" name="estatus" value="Procesando">--}}
                    <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="responsable" value="{{ auth()->user()->name }}">
                    <input type="hidden" name="municipio" value="ROSCIO">
                    <input type="submit" value="Guardar" class="btn btn-success float-right">
                </div>
            </div>
            <br>

            {!! Form::close() !!}




        </div>
    </div>
@endsection

@section('script')
    <script>
        $('[data-mask]').inputmask()
    </script>
@endsection


