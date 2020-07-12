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

            {!! Form::open(['route' => 'datos.store', 'method' => 'POST']) !!}

            <div class="row">
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
                                {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'V-12345678', 'data-inputmask' => '"mask": "A-99999999"', 'data-mask']) !!}
                            </div>
                            <div class="form-group">
                                <label>Nombre Completo</label>
                                {!! Form::text('nombre_completo', null, ['class' => 'form-control', 'placeholder' => 'Nombre Completo']) !!}
                            </div>
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                {!! Form::date('fecha_nac', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sexo</label>
                                {!! Form::select('sexo', ['' => 'Seleccione','Femenino' => 'Femenino', 'Masculino' => 'Masculino'], null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>Lugar de Nacimiento</label>
                                {!! Form::text('lugar_nac', null, ['class' => 'form-control', 'placeholder' => 'Ciudad']) !!}
                            </div>
                            <div class="form-group">
                                <label>Parroquia</label>
                                {!! Form::text('parroquia', null, ['class' => 'form-control', 'placeholder' => 'Donde Vive Actualmente']) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-success">
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
                                        {!! Form::checkbox('estudio', 'SI', null) !!}
                                    </span>
                                </div>
                                {!! Form::text('nombre_estudio', null, ['class' => 'form-control', 'placeholder' => 'Grado de Estudio']) !!}
                            </div>
                            <div class="input-group">
                                <label class="col-md-12">Trabajo</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {!! Form::checkbox('trabajo', 'SI', null) !!}
                                    </span>
                                </div>
                                {!! Form::text('nombre_trabajo', null, ['class' => 'form-control', 'placeholder' => 'Trabajo']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('cargo_trabajo', null, ['class' => 'form-control', 'placeholder' => 'Cargo']) !!}
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Pasatiempo</label>
                                {!! Form::text('pasatiempo', null, ['class' => 'form-control', 'placeholder' => 'Tiempo Libre']) !!}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-success">
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
                                      {!! Form::checkbox('bautizo', 'SI', null) !!}
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="Bautizo" readonly>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      {!! Form::checkbox('comunion', 'SI', null) !!}
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="Comunion" readonly>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      {!! Form::checkbox('confirmacion', 'SI', null) !!}
                                    </span>
                                </div>
                                <input type="text" class="form-control" value="Confirmacion" readonly>
                            </div>

                            <div class="form-group">
                                <label class="col-md-12"> Arquidiosesis</label>
                                {!! Form::text('arquidiosesis', null, ['class' => 'form-control', 'placeholder' => 'arquidiosesis']) !!}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="card card-success">
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
                                {!! Form::text('nombre_representante', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Representante']) !!}
                            </div>
                            <div class="form-group">
                                <label>Telefono</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    {!! Form::text('telefono_representante', null, ['class' => 'form-control', 'placeholder' => 'Numero', 'data-inputmask' => '"mask": "(9999) 999-99.99"', 'data-mask']) !!}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Grupo Juvenil</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {!! Form::checkbox('grupo', 'SI', null) !!}
                                    </span>
                                </div>
                                {!! Form::text('nombre_grupo', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Grupo']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('tiempo_grupo', null, ['class' => 'form-control', 'placeholder' => 'Tiempo en el Grupo']) !!}
                                {!! Form::text('practica_grupo', null, ['class' => 'form-control', 'placeholder' => 'Practicas de Grupo']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="card card-success">
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
                                        {!! Form::checkbox('referido', 'SI', null) !!}
                                    </span>
                                </div>
                                {!! Form::text('referencia', null, ['class' => 'form-control', 'placeholder' => '¿Quien lo Invito?']) !!}
                            </div>
                            <div class="form-group">
                                <label>Motivo del Registro</label>
                                {!! Form::text('motivo_registro', null, ['class' => 'form-control', 'placeholder' => 'Motivo Registro']) !!}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="users_id" value="{{ $users_id }}">
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


