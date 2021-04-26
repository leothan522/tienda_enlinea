@extends("layouts.admin.layout")
@section('title', 'Ventas Web')
@section('web', 'active')
@section('container-title', 'Ventas Web')
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
        <div class="col-md-10">



            <div class="card">
                <div class="card-header bg-warning border-0">
                    <h3 class="card-title">Pedidos Realizados Hoy - <span class="text-bold">({{ $total }})</span></h3>
                    <div class="card-tools">
                        <a href="{{ route('excel.ventas') }}" class="btn btn-tool btn-sm" data-toggle="tooltip" data-placement="top" title="Descargar Excel">
                            <i class="far fa-file-excel"></i>
                            <i class="fas fa-download"></i>
                        </a>
                            <a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                                <i class="fas fa-cart-plus" data-toggle="tooltip" data-placement="top" title="Agregar Pedido"></i>
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
                                <th>N° Pedido</th>
                                <th>Cant. Rubros</th>
                                <th>Monto Total</th>
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
                                    <td class="text-center text-bold">{{ $compra->pedido }}</td>
                                    <td class="text-center">{{ str_pad($compra->capture, 2, "0", STR_PAD_LEFT) }}</td>
                                    <td class="text-center">{{ number_format($compra->monto, 2, ',', '.') }}</td>

                                    <td class="text-center">{{ $compra->estatus }} <strong> {{ $compra->factura }}</strong></td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['ventas.destroy', $compra->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('miembros.edit', $miembro->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            <a href="{{ route('ventas.show', $compra->id) }}" class="btn btn-default btn-sm" title="Ver" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-cog"></i></a>
                                            @if($compra->referencia == null)
                                            <a href="{{ route('ventas.edit', $compra->id) }}" class="btn btn-default btn-sm text-warning" title="Editar" data-toggle="tooltip" data-placement="top">
                                                <i class="fas fa-pencil-alt"></i></a>

                                            <button type="submit" onclick="return confirm('Desea Eliminar el Pedido de {{ $compra->datos->nombre_completo }}')" class="btn btn-default btn-sm text-danger" title="Eliminar" data-toggle="tooltip" data-placement="top">
                                                <i class="far fa-trash-alt"></i></button>
                                            @endif
                                            @if($compra->referencia != null && $compra->factura != null && $compra->estatus != "Despachado")
                                                <a href="{{ route('ventas.despacho.update', $compra->id) }}" class="btn btn-default btn-sm text-success" title="Despachado" onclick="return confirm('Se Despacho la Factura: {{ $compra->factura }}')" data-toggle="tooltip" data-placement="top">
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


    </div>
	<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="col-md-3 float-right text-center">
					<img class="img-thumbnail" src="{{ asset('img/logo_tienda.jpg') }}" alt="Entrar">
                    <legend></legend>
                    @if(config('app.municipio') == 'ROSCIO')
                        <h4 class="text-bold text-navy">Juan German Roscio</h4>
                    @endif
                    @if(config('app.municipio') == 'INFANTE')
                        <h4 class="text-bold text-navy">Leonardo Infante</h4>
                    @endif
                    @if(config('app.municipio') == 'MIRANDA')
                        <h4 class="text-bold text-navy">Francisco de Miranda</h4>
                    @endif
                    @if(config('app.municipio') == 'MONAGAS')
                        <h4 class="text-bold text-navy">Jose Tadeos Monagas</h4>
                    @endif
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
                                <button class="btn btn-default button25" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    <div id="content25" class="col-lg-12">
                        {{-- Contenido inicial...
                         <img src="{{ asset('img/loader.gif') }}"/>--}}
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('.button25').on('click', function(){
                //Añadimos la imagen de carga en el contenedor
                $('#content25').html('<div><br/>Un momento, por favor...</div>');
            });
        });
    </script>
    <script>
        $('[data-mask]').inputmask()
    </script>
@endsection


