@extends("layouts.admin.layout")
@section('title', 'Ventas | Nuevo')
@section('web', 'active')
@section('container-title', 'Ventas Web')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Pedidos Registrados</a></li>
    <li class="breadcrumb-item active">Nuevo Pedido</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            {!! Form::open(['route' => 'ventas.store', 'method' => 'POST']) !!}

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
                            @if($cne)
                                <div class="form-group">
                                    <label>Cedula</label>
                                    {!! Form::text('cedula', $cedula, ['class' => 'form-control', 'placeholder' => 'V-12345678',
                                                    'data-inputmask' => '"mask": "A-99999999"', 'data-mask', 'readonly']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    {!! Form::text('nombre_completo', $nombre, ['class' => 'form-control', 'placeholder' => 'Nombre Completo',
                                                    'readonly']) !!}
                                </div>
                            @else
                                <div class="form-group">
                                    <label>Cedula</label>
                                    {!! Form::text('cedula', $cedula, ['class' => 'form-control', 'placeholder' => 'V-12345678',
                                                    'data-inputmask' => '"mask": "A-99999999"', 'data-mask', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Nombre Completo</label>
                                    {!! Form::text('nombre_completo', null, ['class' => 'form-control', 'placeholder' => 'Nombre Completo',
                                                    'required']) !!}
                                </div>
                            @endif
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
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Pedido</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <label class="col-md-12">N° Pedido</label>
                                {!! Form::number('pedido', null, ['class' => 'form-control', 'placeholder' => 'Numero',
                                                    'min' => 1, 'pattern' => "^[0-9]+", 'required']) !!}
                            </div>
                            <br>
                            <div class="input-group">
                                <label class="col-md-12">Cant. de Rubros</label>
                                {!! Form::number('capture', null, ['class' => 'form-control', 'placeholder' => 'Numero',
                                                    'min' => 1, 'pattern' => "^[0-9]+", 'required']) !!}
                            </div>
                            <br>
                            <div class="input-group">
                                <label class="col-md-12">Monto Total</label>
                                {!! Form::number('monto', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+", 'step' => 'any', 'required']) !!}
                            </div>
                            <br>
                            {{--<div class="input-group">
                                <label class="col-md-12">Referencia</label>
                                {!! Form::text('referencia', null, ['class' => 'form-control', 'placeholder' => 'Referencia', 'data-inputmask' => '"mask": "999999"', 'data-mask', 'required']) !!}
                            </div>--}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="estatus" value="Procesando">
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


