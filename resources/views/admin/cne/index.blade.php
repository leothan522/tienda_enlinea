@extends("layouts.guest.layout")
@section('title', 'Registro CNE')
@section('cne', 'active')
@section('container-title', 'Registro CNE')

@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="{{ asset('docs/Control_de_llamadas_Nuevo.xlsx') }}">Formato Llamadas</a></li>
    <li class="breadcrumb-item"><a href="{{ asset('docs/Control_de_Pedidos_Web.xlsx') }}">Formato Pedidos Web</a></li>--}}
@endsection

@section('content')

    <div class="row justify-content-center">

        <div class="col-md-2">

            <!-- general form elements -->
            <div class="card card-lightblue">
                <div class="card-header">
                    <h3 class="card-title">{{--<i class="nav-icon far fa-file-excel"></i>--}} Registro Electoral</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'cne.show', 'method' => 'POST']) !!}
                <div class="card-body">

                    <div class="form-group text-center">
                        <label>Consultar Cedula</label>
                            <div class="input-group mb-3">
                                <input type="text" name="cedula" class="form-control" placeholder="numero" required>
                                <div class="input-group-append">
                                    {{--<span class="input-group-text">.00</span>--}}
                                    <button class="input-group-text" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                    </div>

                </div>
                <!-- /.card-body -->

                {{--<div class="card-footer text-right">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="id_user" value="">
                    <button type="submit" class="btn bg-purple">Cargar</button>
                </div>--}}

                {!! Form::close() !!}
            </div>
            <!-- /.card -->




        </div>
        <div class="col-md-4">

            <div class="col-md-12 text-center">
                @include("flash::message")
            </div>
            @if($cne)
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="card-header text-center bg-lightblue">
                    {{--<div class="widget-user-image">
                        <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Nadia Carmichael</h3>--}}
                    <h3 class="card-title">Datos del Elector</h3>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Cédula:</span>
                            <span class="float-right text-success">
                                {{ $cne->nacionalidad.'-'.$cne->cedula }}
                            </span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Nombre:</span>
                            <span class="float-right text-success text-bold">
                                {{ $cne->primer_nombre.' '.$cne->segundo_nombre.' '.$cne->primer_apellido.' '.$cne->segundo_apellido }}
                            </span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Estado:</span>
                            <span class="float-right text-success text-xs">EDO. {{ $cne->estado }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Municipio:</span>
                            <span class="float-right text-success text-xs">MP. {{ $cne->municipio }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Parroquia:</span>
                            <span class="float-right text-success text-xs">PQ. {{ $cne->parroquia }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Centro:</span>
                            <span class="float-right text-success text-xs">{{ $cne->centro }}</span>
                        </li>
                        <li class="nav-item nav-link">
                            <span class="text-bold text-muted">Direccion:</span>
                            <span class="float-right text-success text-xs">{{ $cne->direccion }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            @endif



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
        $('[data-mask]').inputmask()
    </script>
@endsection


