@extends("layouts.admin.layout")
@section('title', 'Pedidos | Nuevo')
@section('pedidos', 'active')
@section('container-title', 'Pedidos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pedidos.index') }}">Pedidos Registrados</a></li>
    <li class="breadcrumb-item active">Nuevo Pedido</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            {!! Form::open(['route' => 'pedidos.store', 'method' => 'POST']) !!}

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
                <div class="col-md-3">
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
                                <label class="col-md-12">Modulo 01</label>
                                {!! Form::number('modulo_1', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                   'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                            </div>
                            <br>
                            <div class="input-group">
                                <label class="col-md-12">Modulo 02</label>
                                {!! Form::number('modulo_2', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                            </div>
                            {{--@if(config('app.municipio') == 'ROSCIO')
								<br>
                                <div class="input-group">
                                    <label class="col-md-12">Arma tu combo</label>
                                    {!! Form::number('modulo_3', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                        'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                </div>
                                <br>
                                <div class="input-group">
                                    <label class="col-md-12">Cantidad de Rubros</label>
                                    {!! Form::number('modulo_4', null, ['class' => 'form-control', 'placeholder' => 'cantidad',
                                                        'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                </div>
                                <br>
                                <div class="input-group">
                                    <label class="col-md-12">Monto</label>
                                    {!! Form::number('capture', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+", 'step' => 'any']) !!}
                                </div>
                            @endif--}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
					@if(config('app.adicionales'))
					<div class="card card-success collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Adicionales</h3>

                            <div class="card-tools">
							  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
							  </button>
							</div>
                        </div>
                        <div class="card-body">
                            <div class="input-group">
                                <label class="col-md-12">Cant. de Rubros</label>
                                {!! Form::number('rubros', null, ['class' => 'form-control', 'placeholder' => 'Numero',
                                                    'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                            </div>
                            <br>
                            <div class="input-group">
                                <label class="col-md-12">Monto Total</label>
                                {!! Form::number('monto', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+", 'step' => 'any']) !!}
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
					@endif
				</div>

            @if(config('app.arma_tu_combo'))
				<div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Arma tu Combo</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">

                                {{--<div class="input-group">
                                    <label class="col-md-12">Cant.</label>
                                    {!! Form::number('modulo_3', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                        'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                </div>
                                <br>--}}
                                {{--<div class="input-group">
                                   <label class="col-md-12">Cant. de Rubros</label>
                                   {!! Form::number('modulo_4', null, ['class' => 'form-control', 'placeholder' => 'cantidad',
                                                       'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                               </div>
                               <br>--}}
                                {{--<br>
                                <div class="input-group">
                                    <label class="col-md-12">Monto Total</label>
                                    {!! Form::number('capture', null, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+", 'step' => 'any']) !!}
                                </div>--}}

                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            Cantidad Arma tu combo
                                        </span>
                                    </div>
                                    {!! Form::number('modulo_3', null, ['class' => 'form-control', 'placeholder' => 'Cant.',
                                                    'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                </div>
                                <!-- /input-group -->
                            </div>
                            <br>
                                <div class="input-group">
                                    <label class="col-md-12">Rubros</label>
                                    <div class="field_wrapper">

                                        <div class="input-group justify-content-center">

                                            {!! Form::select('productos[]', $productos, null,
                                                        ['class' => 'form-control chosen-categoria', 'placeholder' => 'Seleccione']) !!}
                                            <span class="col-md-1"></span>
                                            {!! Form::number('cant[]', null, ['class' => 'form-control col-md-2', 'placeholder' => 'Cant.',
                                                            'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                                            <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i></a>
                                            <a href="javascript:void(0);" class="add_button" title="Add field"></a>

                                        </div>
                                    </div>
                                </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
				</div>
            @endif



            </div>

            <div class="row">
                <div class="col-12">
                    <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="fecha" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="estatus" value="Esperando Pago">
                    <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="responsable" value="{{ auth()->user()->name }}">
                    <input type="hidden" name="municipio" value="{{ config('app.municipio') }}">
                    <input type="submit" value="Guardar" class="btn btn-success float-right">
                </div>
            </div>
            <br>

            {!! Form::close() !!}



            {{--<div class="field_wrapper">
                --}}{{--<div>
                    {!! Form::number('field_name[]', null, ['class' => 'form-control', 'placeholder' => 'cantidad',
                                                        'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                    --}}{{----}}{{--<input type="number" name="field_name[]" class="form-control" min="1" pattern="^[0-9]+" value=""/>--}}{{----}}{{--
                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i></a>
                    <a href="javascript:void(0);" class="add_button" title="Add field"></a>
                </div>--}}{{--
                <div class="input-group">

                    --}}{{--<label class="col-md-12">Rubros</label>--}}{{--

                        {!! Form::select('producto[]', ['Miembro' => 'Miembro', 'Administrador' => 'Administrador'], null,
                                    ['class' => 'form-control col-md-7', 'placeholder' => 'Seleccione']) !!}


                        {!! Form::number('cant[]', null, ['class' => 'form-control col-md-4', 'placeholder' => 'Cant.',
                                        'min' => 1, 'pattern' => "^[0-9]+"]) !!}
                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i></a>
                    <a href="javascript:void(0);" class="add_button" title="Add field"></a>


                </div>
            </div>--}}


        </div>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="input-group justify-content-center">' +
                            '<?php echo (Form::select('productos[]', $productos, null,
	                            ['class' => 'form-control chosen-categoria', 'placeholder' => 'Seleccione', 'required']))?>' +
                            '<span class="col-md-1"></span>' +
                            '<?php echo(Form::number('cant[]', null, ['class' => 'form-control col-md-2', 'placeholder' => 'Cant.',
                                                                        'min' => 1, 'pattern' => "^[0-9]+", 'required'])) ?>' +
                                '<a href="javascript:void(0);" class="remove_button text-danger" title="Remove field">' +
                '               <i class="far fa-trash-alt"></i></a>' +
                '           </div>'; //New input field html
            var x = 1; //Initial field counter is 1
            $(addButton).click(function(){ //Once add button is clicked
                if(x < maxField){ //Check maximum number of input fields
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); // Add field html
                    $(".chosen-categoria").chosen({
                        no_results_text: "Sin Resultados para "
                    });
                }
            });
            $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

        $(".chosen-categoria").chosen({
            no_results_text: "Sin Resultados para "
        });



        $('[data-mask]').inputmask()
    </script>
@endsection


