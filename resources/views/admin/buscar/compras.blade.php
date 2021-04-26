@extends("layouts.admin.layout")
@section('title', 'Pedidos | Buscar Fecha')
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

    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'buscar.fecha', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="date" name="buscar" placeholder="Buscar Fecha" aria-label="Buscar" value="{{ $fecha }}" required>
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
        <div class="col-md-11">



            <div class="card">
                <div class="card-header bg-purple border-0">
                    <h3 class="card-title">Pedidos Realizados</h3>
                    <div class="card-tools">
                        {{--<a href="{{ route('excel.pedidos') }}" class="btn btn-tool btn-sm">
                            <i class="far fa-file-excel"></i>
                            <i class="fas fa-download"></i>
                        </a>--}}
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                            <i class="fas fa-cart-plus" data-toggle="tooltip" data-placement="top" title="Agregar Pedido"></i>
                        </a>
                        <a href="{{ route('pedidos.index') }}" class="btn btn-tool btn-sm" data-toggle="tooltip" data-placement="top" title="Cerrar">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Fecha</th>
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
                            @php($i = 0)
                            @php($modulo_1 = 0)
                            @php($modulo_2 = 0)
                            @php($modulo_3 = 0)
                            @foreach($compras as $compra)
                                @php($i++)
                                @php($modulo_1 = $modulo_1 + $compra->modulo_1)
                                @php($modulo_2 = $modulo_2 + $compra->modulo_2)
                                @php($modulo_3 = $modulo_3 + $compra->modulo_3)
                                <tr class="text-center table-warning text-sm">
                                    <th class="text-center bg-gray-dark">{{ $i }}</th>
                                    <td class="text-center">{{ $carbon->parse($compra->fecha)->format('d-M') }}</td>
                                    <td class="text-center">{{ $compra->datos->cedula }}</td>
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
                                            <a href="{{ route('pedidos.show', $compra->id) }}" class="btn btn-default btn-sm" title="Ver" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-cog"></i></a>
                                            @if($compra->referencia == null)
                                                <a href="{{ route('pedidos.edit', $compra->id) }}" class="btn btn-default btn-sm text-warning" title="Editar" data-toggle="tooltip" data-placement="top">
                                                    <i class="fas fa-pencil-alt"></i></a>

                                                <button type="submit" onclick="return confirm('Desea Eliminar el Pedido de {{ $compra->datos->nombre_completo }}')" class="btn btn-default btn-sm text-danger" title="Eliminar" data-toggle="tooltip" data-placement="top">
                                                    <i class="far fa-trash-alt"></i></button>
                                            @endif
                                            @if($compra->referencia != null && $compra->factura != null && $compra->estatus != "Despachado")
                                                <a href="{{ route('despacho.update', $compra->id) }}" class="btn btn-default btn-sm text-success" title="Despachado" onclick="return confirm('Se Despacho la Factura: {{ $compra->factura }}')" data-toggle="tooltip" data-placement="top">
                                                    <i class="fas fa-truck"></i></a>
                                            @endif
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="text-center text-sm">
                                <td colspan="5"></td>
                                <td class="text-center bg-gray-dark">{{ str_pad($modulo_1, 2, "0", STR_PAD_LEFT) }}</td>
                                <td class="text-center bg-gray-dark">{{ str_pad($modulo_2, 2, "0", STR_PAD_LEFT) }}</td>
                                @if(config('app.arma_tu_combo'))
									<td class="text-center bg-gray-dark">{{ str_pad($modulo_3, 2, "0", STR_PAD_LEFT) }}</td>
								@endif
								<td colspan="2"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-sm justify-content-end">
                        {{--{!! $compras->render() !!}--}}
                    </div>
                </div>
            </div>



        </div>


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


