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
        <div class="col-md-10">

            {!! Form::open(['route' => ['datos.update', $datos->id], 'method' => 'PUT']) !!}

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
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
                                {!! Form::text('cedula', $datos->cedula, ['class' => 'form-control', 'placeholder' => 'V-12345678', 'data-inputmask' => '"mask": "A-99999999"', 'data-mask']) !!}
                            </div>
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                {!! Form::text('nombre_completo', $datos->nombre_completo, ['class' => 'form-control', 'placeholder' => 'Nombre Completo']) !!}
                            </div>
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                {!! Form::date('fecha_nac', $datos->fecha_nac, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    {!! Form::text('telefono', $datos->telefono, ['class' => 'form-control', 'placeholder' => 'Numero', 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sexo</label>
                                {!! Form::select('sexo', ['' => 'Seleccione','Femenino' => 'Femenino', 'Masculino' => 'Masculino'], $datos->sexo, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Lugar de Nacimiento</label>
                                {!! Form::text('lugar_nac', $datos->lugar_nac, ['class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
                            </div>
                            <div class="form-group">
                                <label>Parroquia</label>
                                {!! Form::text('parroquia', $datos->parroquia, ['class' => 'form-control', 'placeholder' => 'Donde Vive Actualmente']) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Academicos / Laboral</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <label class="col-md-12">Estudios</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($datos->estudio == "SI")
                                            @php($estudio = 'checked')
                                        @else
                                            @php($estudio = null)
                                        @endif
                                        {!! Form::checkbox('estudio', 'SI', $estudio) !!}
                                    </span>
                                </div>
                                {!! Form::text('nombre_estudio', $datos->nombre_estudio, ['class' => 'form-control', 'placeholder' => 'Grado de Estudio']) !!}
                            </div>
                            <div class="input-group">
                                <label class="col-md-12">Trabajo</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($datos->trabajo == "SI")
                                            @php($trabajo = 'checked')
                                        @else
                                            @php($trabajo = null)
                                        @endif
                                        {!! Form::checkbox('trabajo', 'SI', $trabajo) !!}
                                    </span>
                                </div>
                                {!! Form::text('nombre_trabajo', $datos->nombre_trabajo, ['class' => 'form-control', 'placeholder' => 'Trabajo']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('cargo_trabajo', $datos->cargo_trabajo, ['class' => 'form-control', 'placeholder' => 'Cargo']) !!}
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Pasatiempo</label>
                                {!! Form::text('pasatiempo', $datos->pasatiempo, ['class' => 'form-control', 'placeholder' => 'Tiempo Libre']) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sacramentos</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($datos->bautizo == "SI")
                                            @php($bautizo = 'checked')
                                        @else
                                            @php($bautizo = null)
                                        @endif
                                      {!! Form::checkbox('bautizo', 'SI', $bautizo) !!}
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="Bautizo" readonly>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($datos->comunion == "SI")
                                            @php($comunion = 'checked')
                                        @else
                                            @php($comunion = null)
                                        @endif
                                      {!! Form::checkbox('comunion', 'SI', $comunion) !!}
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="Comunion" readonly>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($datos->confirmacion == "SI")
                                            @php($confirmacion = 'checked')
                                        @else
                                            @php($confirmacion = null)
                                        @endif
                                      {!! Form::checkbox('confirmacion', 'SI', $confirmacion) !!}
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="Confirmacion" readonly>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12"> Arquidiosesis</label>
                                {!! Form::text('arquidiosesis', $datos->arquidiosesis, ['class' => 'form-control', 'placeholder' => 'arquidiosesis']) !!}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Representante</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre Representante</label>
                                <input type="hidden" name="id_representante" value="{{ $representante->id }}">
                                {!! Form::text('nombre_representante', $representante->nombre_representante, ['class' => 'form-control', 'placeholder' => 'Nombre del Representante']) !!}
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    {!! Form::text('telefono_representante', $representante->telefono_representante, ['class' => 'form-control', 'placeholder' => 'Numero', 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask']) !!}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Grupos</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($datos->grupo == "SI")
                                            @php($grupo = 'checked')
                                        @else
                                            @php($grupo = null)
                                        @endif
                                        {!! Form::checkbox('grupo', 'SI', $grupo) !!}
                                    </span>
                                </div>
                                {!! Form::text('nombre_grupo', $datos->nombre_grupo, ['class' => 'form-control', 'placeholder' => 'Nombre del Grupo']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('tiempo_grupo', $datos->tiempo_grupo, ['class' => 'form-control', 'placeholder' => 'Tiempo en el Grupo']) !!}
                                {!! Form::text('practica_grupo', $datos->practica_grupo, ['class' => 'form-control', 'placeholder' => 'Practicas de Grupo']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Referencia</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        @if($datos->referencia == null)
                                            @php($referido = null)
                                        @else
                                            @php($referido = 'checked')
                                        @endif
                                        {!! Form::checkbox('referido', 'SI', $referido) !!}
                                    </span>
                                </div>
                                {!! Form::text('referencia', $datos->referencia, ['class' => 'form-control', 'placeholder' => 'Referido por']) !!}
                            </div>
                            <div class="form-group">
                                <label>Motivo del Registro</label>
                                {!! Form::text('motivo_registro', $datos->motivo_registro, ['class' => 'form-control', 'placeholder' => 'Motivo Registro']) !!}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="users_id" value="{{ $users_id }}">
                    <input type="submit" value="Guardar" class="btn btn-primary float-right">
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


