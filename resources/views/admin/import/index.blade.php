@extends("layouts.admin.layout")
@section('title', 'Import | Excel')
@section('import', 'active')
@section('container-title', 'Import')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ asset('docs/Control_de_llamadas_Nuevo.xlsx') }}">Formato Llamadas</a></li>
    <li class="breadcrumb-item"><a href="{{ asset('docs/Control_de_Pedidos_Web.xlsx') }}">Formato Pedidos Web</a></li>
@endsection

@section('buscar')
    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'buscar.cedula', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Cedula" aria-label="Buscar" data-inputmask='"mask": "A-99999999"' data-mask required>
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
        <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Factura" aria-label="Buscar" data-inputmask='"mask": "99999"' data-mask required>
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
        <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Referencia" aria-label="Buscar" data-inputmask='"mask": "999999"' data-mask required>
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
            <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Pedido Web" aria-label="Buscar" required>
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

    <div class="offset-2 col-md-8 row">
        <div class="col-md-5">



            <!-- general form elements -->
            <div class="card card-purple">
                <div class="card-header">
                    <h3 class="card-title"><i class="nav-icon far fa-file-excel"></i> Import Llamadas</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'import.llamadas', 'method' => 'POST', 'files' => true, 'id' => 'form1']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label>Archivo Excel</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input" accept=".xlsx, .xls" required>
                                <label class="custom-file-label" for="exampleInputFile">Elija el archivo</label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="id_user" value="">
                    <button type="submit" class="btn bg-purple">Cargar</button>
                </div>

                {!! Form::close() !!}
            </div>
            <!-- /.card -->




        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5">



            <!-- general form elements -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="nav-icon far fa-file-excel"></i> Import Pedidos Web</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                {!! Form::open(['route' => 'import.web', 'method' => 'POST', 'files' => true, 'id' => 'form2']) !!}
                <div class="card-body">

                    <div class="form-group">
                        <label>Archivo Excel</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="excel" class="custom-file-input" accept=".xlsx, .xls" required>
                                <label class="custom-file-label" for="exampleInputFile">Elija el archivo</label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="hidden" name="id_user" value="">
                    <button type="submit" class="btn btn-warning">Cargar</button>
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
        $('[data-mask]').inputmask()
    </script>
@endsection


