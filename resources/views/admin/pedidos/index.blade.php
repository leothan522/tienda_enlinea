@extends("layouts.admin.layout")
@section('title', 'Pedidos')
@section('pedidos', 'active')
@section('container-title', 'Pedidos')
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

    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'buscar.fecha', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
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

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-9">



            <div class="card">
                <div class="card-header bg-purple border-0">
                    <h3 class="card-title">Pedidos Realizados Hoy - <span class="text-lime text-bold">({{ $total }})</span></h3>
                    <div class="card-tools">
                        <a href="{{ route('excel.pedidos') }}" class="btn btn-tool btn-sm">
                            <i class="far fa-file-excel"></i>
                            <i class="fas fa-download"></i>
                        </a>
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
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Cedula</th>
                                <th>Nombre Completo</th>
                                <th>Telefono</th>
                                <th>Modulo 01</th>
                                <th>Modulo 02</th>
								@if(config('app.arma_tu_combo'))
									<th>Arma tu Combo</th>
								@endif
                                <th>Estatus</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($compras as $compra)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        {{ $compra->datos->cedula }}
                                    </td>
                                    <td class="text-left">{{ $compra->datos->nombre_completo }}</td>
                                    <td class="text-center">{{ $compra->datos->telefono }}</td>
                                    <td class="text-center text-bold">{{ $compra->modulo_1 }}</td>
                                    <td class="text-center text-bold">{{ $compra->modulo_2 }}</td>
									@if(config('app.arma_tu_combo'))
										<td class="text-center text-bold">{{ $compra->modulo_3 }}</td>
									@endif
                                    <td class="text-center">{{ $compra->estatus }} <strong> {{ $compra->factura }}</strong></td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['pedidos.destroy', $compra->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('miembros.edit', $miembro->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('pedidos.show', $compra->id) }}" class="btn btn-default btn-sm" title="Ver">
                                                <i class="fas fa-cog"></i></a>
                                            @if($compra->referencia == null)
                                            <a href="{{ route('pedidos.edit', $compra->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>

                                            <button type="submit" onclick="return confirm('Desea Eliminar el Pedido de {{ $compra->datos->nombre_completo }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                <i class="far fa-trash-alt"></i></button>
                                            @endif
                                            @if($compra->referencia != null && $compra->factura != null && $compra->estatus != "Despachado")
                                                <a href="{{ route('despacho.update', $compra->id) }}" class="btn btn-default btn-sm text-success" title="Despachado" onclick="return confirm('Se Despacho la Factura: {{ $compra->factura }}')">
                                                    <i class="fas fa-truck"></i></a>
                                            @endif
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-sm justify-content-end">
                        {!! $compras->render() !!}
                    </div>
                </div>
            </div>


        </div>

        <div class="col-md-2">
            <!-- LLAMADAS -->
            <div class="card">
                <div class="card-header bg-purple">
                    <h3 class="card-title"><i class="fas fa-phone"></i></a> NO efectivas</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm-llamada">
                            <i class="fas fa-cog"></i></a>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item nav-link text-center">
                            @if($llamadas)
                                {!! Form::open(['route' => ['llamada.update', $llamadas->id], 'method' => 'PUT', 'role' => 'form']) !!}
                                <span class="float-left badge bg-primary">{{ $llamadas->costo }}</span>
                                COSTO
                                <input type="hidden" name="costo" value="{{ $llamadas->costo + 1 }}">
                                <button type="submit" class="btn btn-xs btn-info float-right"
                                        onclick="return confirm('Agregar una llamada NO efectiva por COSTO')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => 'llamada.store', 'method' => 'POST', 'role' => 'form']) !!}
                                    <span class="float-left badge bg-primary"></span>
                                    COSTO
                                    <input type="hidden" name="fecha" value="{{ date("Y-m-d") }}">
                                    <input type="hidden" name="municipio" value="ROSCIO">
                                    <input type="hidden" name="costo" value="1">
                                    <button type="submit" class="btn btn-xs btn-info float-right"
                                            onclick="return confirm('Agregar una llamada NO efectiva por COSTO')">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                {!! Form::close() !!}
                            @endif
                        </li>
                        <li class="nav-item nav-link text-center">
                            @if($llamadas)
                                {!! Form::open(['route' => ['llamada.update', $llamadas->id], 'method' => 'PUT', 'role' => 'form']) !!}
                                <span class="float-left badge bg-primary">{{ $llamadas->recurso }}</span>
                                RECURSOS
                                <input type="hidden" name="recurso" value="{{ $llamadas->recurso + 1 }}">
                                <button type="submit" class="btn btn-xs btn-info float-right"
                                        onclick="return confirm('Agregar una llamada NO efectiva por RECURSOS')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => 'llamada.store', 'method' => 'POST', 'role' => 'form']) !!}
                                <span class="float-left badge bg-primary"></span>
                                RECURSOS
                                <input type="hidden" name="fecha" value="{{ date("Y-m-d") }}">
                                <input type="hidden" name="municipio" value="ROSCIO">
                                <input type="hidden" name="recurso" value="1">
                                <button type="submit" class="btn btn-xs btn-info float-right"
                                        onclick="return confirm('Agregar una llamada NO efectiva por RECURSOS')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            @endif
                        </li>
                        <li class="nav-item nav-link text-center">
                            @if($llamadas)
                                {!! Form::open(['route' => ['llamada.update', $llamadas->id], 'method' => 'PUT', 'role' => 'form']) !!}
                                <span class="float-left badge bg-primary">{{ $llamadas->rubro }}</span>
                                OTROS RUBROS
                                <input type="hidden" name="rubro" value="{{ $llamadas->rubro + 1 }}">
                                <button type="submit" class="btn btn-xs btn-info float-right"
                                        onclick="return confirm('Agregar una llamada NO efectiva por OTROS RUBROS')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => 'llamada.store', 'method' => 'POST', 'role' => 'form']) !!}
                                <span class="float-left badge bg-primary"></span>
                                OTROS RUBROS
                                <input type="hidden" name="fecha" value="{{ date("Y-m-d") }}">
                                <input type="hidden" name="municipio" value="ROSCIO">
                                <input type="hidden" name="rubro" value="1">
                                <button type="submit" class="btn btn-xs btn-info float-right"
                                        onclick="return confirm('Agregar una llamada NO efectiva por OTROS RUBROS')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            @endif
                        </li>
                        <li class="nav-item nav-link text-center">
                            @if($llamadas)
                                {!! Form::open(['route' => ['llamada.update', $llamadas->id], 'method' => 'PUT', 'role' => 'form']) !!}
                                <span class="float-left badge bg-primary">{{ $llamadas->informacion }}</span>
                                INFORMACIÓN
                                <input type="hidden" name="informacion" value="{{ $llamadas->informacion + 1 }}">
                                <button type="submit" class="btn btn-xs btn-info float-right"
                                        onclick="return confirm('Agregar una llamada NO efectiva por INFORMACIÓN')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => 'llamada.store', 'method' => 'POST', 'role' => 'form']) !!}
                                <span class="float-left badge bg-primary"></span>
                                INFORMACIÓN
                                <input type="hidden" name="fecha" value="{{ date("Y-m-d") }}">
                                <input type="hidden" name="municipio" value="ROSCIO">
                                <input type="hidden" name="informacion" value="1">
                                <button type="submit" class="btn btn-xs btn-info float-right"
                                        onclick="return confirm('Agregar una llamada NO efectiva por INFORMACIÓN')">
                                    <i class="fas fa-plus"></i>
                                </button>
                                {!! Form::close() !!}
                            @endif
                        </li>
                        @if($llamadas)
                        <li class="nav-item nav-link text-center">
                            <span class="text-danger text-bold">
                                {{ $llamadas->costo + $llamadas->recurso + $llamadas->rubro + $llamadas->informacion }}
                            </span>
                        </li>
                        @endif

                    </ul>
                </div>
                <!-- /.card-body -->
            </div>

			<div class="col-md-12">
				<img class="img-thumbnail" src="{{ asset('img/logo_tienda.jpg') }}" alt="Entrar">
			</div>
            <legend></legend>
            <div class="col-md-12">
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
                <legend></legend>
            </div>


        </div>


    </div>


    {{-- modal cedula--}}
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
                            <input class="form-control" type="text" name="cedula" placeholder="Buscar Cedula"
                                   data-inputmask='"mask": "A-99999999"' data-mask required>
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

    {{-- modal cedula--}}
    <div class="modal fade" id="modal-sm-llamada">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-phone"></i></a> NO efectivas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if($llamadas)
                    {!! Form::open(['route' => ['llamada.update', $llamadas->id], 'method' => 'PUT', 'role' => 'form']) !!}
                    <div class="modal-body">

                        <div class="form-group">
                            {!! Form::number('costo', $llamadas->costo, ['class' => 'form-control', 'placeholder' => 'COSTO']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number('recurso', $llamadas->recurso, ['class' => 'form-control', 'placeholder' => 'RECURSOS']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number('rubro', $llamadas->rubro, ['class' => 'form-control', 'placeholder' => 'OTROS RUBROS']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number('informacion', $llamadas->informacion, ['class' => 'form-control', 'placeholder' => 'INFORMACIÓN']) !!}
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    {!! Form::close() !!}
                    @else
                    {!! Form::open(['route' => 'llamada.store', 'method' => 'POST', 'role' => 'form']) !!}
                    <div class="modal-body">


                        <div class="form-group">
                            {!! Form::number('costo', null, ['class' => 'form-control', 'placeholder' => 'COSTO']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number('recurso', null, ['class' => 'form-control', 'placeholder' => 'RECURSOS']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number('rubro', null, ['class' => 'form-control', 'placeholder' => 'OTROS RUBROS']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::number('informacion', null, ['class' => 'form-control', 'placeholder' => 'INFORMACIÓN']) !!}
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="fecha" value="{{ date("Y-m-d") }}">
                        <input type="hidden" name="municipio" value="ROSCIO">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    {!! Form::close() !!}
                @endif
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


