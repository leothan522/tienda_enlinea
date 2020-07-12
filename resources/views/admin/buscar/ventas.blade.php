@extends("layouts.admin.layout")
@section('title', 'Ventas')
@section('web', 'active')
@section('container-title', 'Ventas Web')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#modal-sm">Agregar Pedido</a></li>
@endsection

@section('buscar')
    <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'ventas.buscar.cedula', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
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

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-11">



            <div class="card">
                <div class="card-header bg-warning border-0">
                    <h3 class="card-title">Pedidos Realizados</h3>
                    <div class="card-tools">
                        {{--<a href="{{ route('excel.date', "2020-06-12") }}" class="btn btn-tool btn-sm">
                            <i class="far fa-file-excel"></i>
                            <i class="fas fa-download"></i>
                        </a>--}}
                        <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        <a href="{{ route('ventas.index') }}" class="btn btn-tool btn-sm">
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
                                <th>N° Pedido</th>
                                <th>Cant. Rubros</th>
                                <th>Monto</th>
                                <th>Estatus</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 0)
                            @php($rubros = 0)
                            @php($monto = 0)
                            @foreach($compras as $compra)
                                @php($i++)
                                @php($rubros = $rubros + $compra->capture)
                                @php($monto = $monto + $compra->monto)
                                <tr class="text-center table-warning text-sm">
                                    <th class="text-center bg-gray-dark">{{ $i }}</th>
                                    <td class="text-center">{{ $carbon->parse($compra->fecha)->format('d-M') }}</td>
                                    <td class="text-center">
                                        {{ $compra->datos->cedula }}
                                    </td>
                                    <td class="text-left">{{ $compra->datos->nombre_completo }}</td>
                                    <td class="text-center">{{ $compra->datos->telefono }}</td>
                                    <td class="text-center text-bold">{{ $compra->pedido }}</td>
                                    <td class="text-center">{{ str_pad($compra->capture, 2, "0", STR_PAD_LEFT) }}</td>
                                    <td class="text-center">{{ number_format($compra->monto, 2, ',', '.') }}</td>

                                    <td class="text-center">{{ $compra->estatus }} <strong> {{ $compra->factura }}</strong></td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['ventas.destroy', $compra->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('miembros.edit', $miembro->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('ventas.show', $compra->id) }}" class="btn btn-default btn-sm" title="Ver">
                                                <i class="fas fa-cog"></i></a>
                                            @if($compra->referencia == null)
                                                <a href="{{ route('ventas.edit', $compra->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                    <i class="fas fa-pencil-alt"></i></a>

                                                <button type="submit" onclick="return confirm('Desea Eliminar el Pedido de {{ $compra->datos->nombre_completo }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                    <i class="far fa-trash-alt"></i></button>
                                            @endif
                                            @if($compra->referencia != null && $compra->factura != null && $compra->estatus != "Despachado")
                                                <a href="{{ route('ventas.despacho.update', $compra->id) }}" class="btn btn-default btn-sm text-success" title="Despachado" onclick="return confirm('Se Despacho la Factura: {{ $compra->factura }}')">
                                                    <i class="fas fa-truck"></i></a>
                                            @endif
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="text-center text-sm">
                                <td colspan="6"></td>
                                <td class="text-center bg-gray-dark">{{ number_format(str_pad($rubros, 2, "0", STR_PAD_LEFT), 0, ',', '.') }}</td>
                                <td class="text-center bg-gray-dark">{{ number_format($monto, 2, ',', '.') }}</td>
                                <td colspan="2"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row text-sm justify-content-end">
                       {{-- {!! $compras->render() !!}--}}
                    </div>
                </div>
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
                    {!! Form::open(['route' => 'ventas.cedula.create', 'method' => 'POST', 'role' => 'form']) !!}
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


