@extends('layouts.admin.layout')
@section('title', 'Home')
@section('container-title', 'Home')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#modal-sm">Agregar Pedido</a></li>
@endsection

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
    {!! Form::open(['route' => 'buscar.factura', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
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
    {!! Form::open(['route' => 'buscar.referencia', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" size="10%" type="text" name="buscar" placeholder="Referencia" aria-label="Buscar" data-inputmask='"mask": "999999"' data-mask required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    {!! Form::close() !!}

    @if(config('app.pagina_web'))
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
    @endif
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-phone"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Llamadas Recibidas</span>
                        <span class="info-box-number text-center">
                        {{ $llamadas }}
                        {{--<small>%</small>--}}
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pedidos Realizados</span>
                        <span class="info-box-number text-center">{{ $pedidos }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Llamadas NO Efectivas</span>
                        <span class="info-box-number text-center">
                            {{ $no_efectivas }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pedidos Facturados</span>
                        <span class="info-box-number text-center">{{ $facturas }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

        </div>
        <div class="row justify-content-center">
            @if(config('app.pagina_web'))
                <div class="col-md-2">
                <!-- REPORTES -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="far fa-envelope"></i> Ventas Web</h3>

                        {{--<div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>--}}
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.ventas') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('ventas.excel.sub01') }}" class="nav-link">
                                    {{--<span class="float-right text-xs text-primary">(2)</span>--}}
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(1)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('ventas.excel.sub02') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(2)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('ventas.excel.sub03') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(3)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('ventas.excel.sub04') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(4)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('ventas.excel.sub05') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(5)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('ventas.excel.sub06') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(6)->format('d-M') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Bienvenid<small>@</small>
                        <div class="card-tools">
                            {{--<a href="{{ route('excel.pedidos') }}" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>--}}
                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                            {{--<a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-cog"></i>
                            </a>--}}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 text-center">
                                <br>
                                <img class="img-thumbnail" src="{{ asset('img/logo_tienda.jpg') }}" alt="Entrar">
                                {{--<br>
                                <p>Nombre: <strong>{{ ucwords(auth()->user()->name) }}</strong></p>
                                <p>Correo: <strong>{{ auth()->user()->email }}</strong></p>
                                <p>Municipio: <strong>{{ config('app.municipio') }}</strong></p>--}}
                                <br>
                                <br>
                                <legend></legend>
                                @if(config('app.municipio') == 'ROSCIO')
                                    <h2 class="text-bold text-navy">Juan German Roscio</h2>
                                @endif
                                @if(config('app.municipio') == 'INFANTE')
                                    <h2 class="text-bold text-navy">Leonardo Infante</h2>
                                @endif
                                @if(config('app.municipio') == 'MIRANDA')
                                    <h2 class="text-bold text-navy">Francisco de Miranda</h2>
                                @endif
                                @if(config('app.municipio') == 'MONAGAS')
                                    <h2 class="text-bold text-navy">Jose Tadeos Monagas</h2>
                                @endif
                                <p></p>
                            </div>
                            <div class="col-lg-4">
                                <br>
                                @if(config('app.municipio') == 'ROSCIO')
                                    <img class="img-thumbnail" src="{{ asset('img/carousel/mun_roscio.jpg') }}" alt="Entrar">
                                @endif
                                @if(config('app.municipio') == 'INFANTE')
                                    <img class="img-thumbnail" src="{{ asset('img/carousel/mun_infante.jpg') }}" alt="Entrar">
                                @endif
                                @if(config('app.municipio') == 'MIRANDA')
                                    <img class="img-thumbnail" src="{{ asset('img/carousel/mun_miranda.jpg') }}" alt="Entrar">
                                @endif
                                @if(config('app.municipio') == 'MONAGAS')
                                    <img class="img-thumbnail" src="{{ asset('img/carousel/mun_monagas.jpg') }}" alt="Entrar">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <!-- REPORTES -->
                <div class="card card-purple">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-shopping-cart"></i> Pedidos</h3>

                        {{--<div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>--}}
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.pedidos') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.sub01') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(1)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.sub02') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(2)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.sub03') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(3)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.sub04') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(4)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.sub05') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(5)->format('d-M') }}
                                </a>
                            </li>
                            <li class="nav-item text-center">
                                <a href="{{ route('excel.sub06') }}" class="nav-link">
                                    <i class="far fa-file-excel"></i> <i class="fas fa-download"></i> {{ $carbon->parse(date('Y-m-d'))->subDay(6)->format('d-M') }}
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>

        @if(config('app.pagina_web'))
            <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-cloud"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pedidos Web</span>
                        <span class="info-box-number text-center">
                        {{ $web }}
                            {{--<small>%</small>--}}
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Web Facturados</span>
                        <span class="info-box-number text-center">{{ $web_fact }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

        </div>
        @endif

    </div>


    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- SEARCH FORM -->
                    {!! Form::open(['route' => 'cedula.create', 'method' => 'POST', 'role' => 'form']) !!}
                    <div class="input-group input-group">
                        <input class="form-control" type="text" name="cedula" placeholder="Buscar Cedula" data-inputmask='"mask": "A-99999999"' data-mask required>
                        <div class="input-group-append">
                            <button class="btn btn-default" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                <!-- SEARCH FORM -->
                    {{--<legend></legend>
                    <form>
                        <div class="input-group input-group">
                            <input class="form-control" type="text" placeholder="Buscar Nombre" required>
                            <div class="input-group-append">
                                <button class="btn btn-default" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>--}}
                </div>
                {{--<div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>--}}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->




@endsection

@section('script')
    {{--<script>
        jQuery(document).ready(function($) {
            $('a[data-rel^=lightcase]').lightcase();
        });

    </script>--}}
    <script>
        $('[data-mask]').inputmask()
    </script>
@endsection
