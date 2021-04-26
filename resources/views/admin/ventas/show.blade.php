@extends("layouts.admin.layout")
@section('title', 'Ventas | Ver')
@section('web', 'active')
@section('container-title', 'Ventas Web')

@section('buscar')
    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'buscar.cedula', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" size="10%" type="text" name="buscar" placeholder="Cedula" aria-label="Buscar" data-inputmask='"mask": "A-99999999"' data-mask required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    {!! Form::close() !!}
    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'ventas.buscar.factura', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" size="10%" type="text" name="buscar" placeholder="Factura" aria-label="Buscar" data-inputmask='"mask": "99999"' data-mask required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    {!! Form::close() !!}
    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'ventas.buscar.referencia', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" size="10%" type="text" name="buscar" placeholder="Referencia" aria-label="Buscar" data-inputmask='"mask": "999999"' data-mask required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    {!! Form::close() !!}

    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'ventas.buscar.pedido', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" size="10%" type="text" name="buscar" placeholder="Pedido Web" aria-label="Buscar" required>
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}

    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'ventas.buscar.fecha', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="date" name="buscar" placeholder="Buscar Fecha" aria-label="Buscar" required>
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Pedidos Registrados</a></li>
    <li class="breadcrumb-item active">Ver Pedido</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-primary">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="{{ asset('dist/img/pedido-png-5.png') }}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $compra->datos->nombre_completo }}</h3>
                    <h5 class="widget-user-desc">{{ $compra->datos->cedula }}</h5>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Telefono:</span>
                            <span class="float-right text-success">{{ $compra->datos->telefono }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">N° Pedido:</span>
                            <span class="float-right text-success text-bold">{{ $compra->pedido }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Cant. Rubros:</span>
                            <span class="float-right text-success text-bold">{{ str_pad($compra->capture, 2, "0", STR_PAD_LEFT) }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Monto Total:</span>
                            <span class="float-right text-success text-bold">{{ number_format($compra->monto, 2, ',', '.') }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Fecha del Pedido:</span>
                            <span class="float-right text-success">{{ $carbon->parse($compra->fecha)->format('d-m-Y') }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Direccion:</span>
                            <span class="float-right text-success">{{ $compra->datos->direccion }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Estatus:</span>
                            <span class="float-right text-success">{{ $compra->estatus}}</span>
                        </li>
                    </ul>
                </div>
            </div>



        </div>

        <div class="col-md-3">


            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Facturación</h3>
                    <div class="card-tools">
                        @if($compra->referencia != null && $compra->factura != null)
                            @if ($compra->estatus != "Despachado")
                                <a href="{{ route('ventas.despacho.update', $compra->id) }}" class="btn btn-tool btn-sm" title="Despachado" onclick="return confirm('Se Despacho la Factura: {{ $compra->factura }}')" data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-truck"></i></a>
                            @else
                                <a href="{{ route('ventas.despacho.update', $compra->id) }}" class="btn btn-tool btn-sm" title="NO Despachado" onclick="return confirm('NO se ha Despachado la Factura: {{ $compra->factura }}')" data-toggle="tooltip" data-placement="top">
                                    <i class="fas fa-truck-loading"></i></a>
                            @endif
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => ['ventas.update', $compra->id], 'method' => 'PUT', 'role' => 'form']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Referencia</label>
                        {!! Form::text('referencia', $compra->referencia, ['class' => 'form-control', 'placeholder' => 'Referencia', 'data-inputmask' => '"mask": "999999"', 'data-mask']) !!}
                    </div>
                    <div class="form-group">
                        <label for="name">Factura</label>
                        {!! Form::text('factura', $compra->factura, ['class' => 'form-control', 'placeholder' => 'Factura', 'data-inputmask' => '"mask": "99999"', 'data-mask']) !!}
                    </div>
                    @if($compra->estatus == "Despachado")
                        <div class="callout callout-success">
                            <h5>Despachado!</h5>
                        </div>
                    @endif

                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <input type="hidden" name="estatus" value="Esperando Factura">
                    <input type="hidden" name="datos_id" value="{{ $compra->datos->id }}">
                    <input type="hidden" name="responsable" value="{{ auth()->user()->name }}">
                    @if($compra->estatus == "Despachado" && auth()->user()->type != "Administrador")
                        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                        @else
                        <a href="javascript:history.back()" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    @endif
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.card -->

        </div>


    </div>

@endsection

@section('script')
    {{--<script>
        jQuery(document).ready(function($) {
            $('a[data-rel^=lightcase]').lightcase();
        });

    </script>--}}
    <script>
        $('[data-mask]').inputmask();
        $(".chosen-select").chosen({
            no_results_text: "Sin Resultados para "
        });
    </script>
@endsection


