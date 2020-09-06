@extends("layouts.admin.layout")
@section('title', 'Productos')
@section('productos', 'active')
@section('container-title', 'Productos')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('productos.create') }}">Agregar Producto</a></li>
@endsection

@section('buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" {{--size="10%"--}} type="text" name="buscar" placeholder="Rubro" aria-label="Buscar" required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    {{--<!-- SEARCH FORM -->
    {!! Form::open(['route' => 'ventas.buscar.cedula', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Cedula" aria-label="Buscar" data-inputmask='"mask": "A-99999999"' data-mask required>
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}--}}
   {{-- <!-- SEARCH FORM -->
    {!! Form::open(['route' => 'ventas.buscar.factura', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Factura" aria-label="Buscar" data-inputmask='"mask": "99999"' data-mask required>
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}--}}
    <!-- SEARCH FORM -->
    {{--{!! Form::open(['route' => 'ventas.buscar.referencia', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Referencia" aria-label="Buscar" data-inputmask='"mask": "999999"' data-mask required>
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}--}}

    <!-- SEARCH FORM -->
    {{--{!! Form::open(['route' => 'ventas.buscar.pedido', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="text" name="buscar" placeholder="Buscar Pedido" aria-label="Buscar" required>
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}--}}

    <!-- SEARCH FORM -->
    {{--{!! Form::open(['route' => 'ventas.buscar.fecha', 'method' => 'POST', 'role' => 'form', 'class' => 'form-inline ml-3']) !!}
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="date" name="buscar" placeholder="Buscar Fecha" aria-label="Buscar" required>
        <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {!! Form::close() !!}--}}

@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-4">


            <div class="card">
                <div class="card-header bg-indigo border-0">
                    <h3 class="card-title">Modulos</h3>
                    <div class="card-tools">
                        {{--<a href="{{ route('excel.ventas') }}" class="btn btn-tool btn-sm">
                            <i class="far fa-file-excel"></i>
                            <i class="fas fa-download"></i>
                        </a>--}}
                        {{--<a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        --}}
                        <a href="{{ route('mod.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-tag"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Nombre</th>
                                <th>Rubros</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modulos as $modulo)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        <span class="text-bold">{{ ucwords($modulo->nombre) }}</span>
                                    </td>
                                    <td class="text-center text-bold">{{ str_pad($modulo->rubros, 2, "0", STR_PAD_LEFT) }}</td>
                                    <td class="text-center text-bold">{{ number_format($modulo->precio, 2, ',', '.') }}</td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['productos.destroy', $modulo->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            {{--<a href="{{ route('productos.show', $producto->id) }}" class="btn btn-default btn-sm" title="Ver">
                                                <i class="fas fa-cog"></i></a>--}}
                                            <a href="{{ route('mod.edit', $modulo->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            @if(auth()->user()->type == "Administrador")
                                            <button type="submit" onclick="return confirm('Desea Eliminar al Rubro {{ $modulo->nombre }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                <i class="far fa-trash-alt"></i></button>
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
                        {!! $productos->render() !!}
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-6 offset-1">


            <div class="card">
                <div class="card-header bg-indigo border-0">
                    <h3 class="card-title">Productos Registrados - <span class="text-bold">({{ $total }})</span></h3>
                    <div class="card-tools">
                        {{--<a href="{{ route('excel.ventas') }}" class="btn btn-tool btn-sm">
                            <i class="far fa-file-excel"></i>
                            <i class="fas fa-download"></i>
                        </a>--}}
                        {{--<a href="#" class="btn btn-tool btn-sm" data-toggle="modal" data-target="#modal-sm">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        --}}
                        <a href="{{ route('productos.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-tag"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                            <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Modalidad</th>
                                <th>Nombre del Rubro</th>
                                <th>Precio</th>
                                <th>Estatus</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productos as $producto)

                                <tr class="text-center table-primary text-sm">
                                    <td class="text-center">
                                        <span class="text-bold">{{ ucwords($producto->modalidad) }}</span>
                                    </td>
                                    <td class="text-left">{{ $producto->nombre }}</td>
                                    <td class="text-center text-bold">{{ number_format($producto->precio, 2, ',', '.') }}</td>
                                    <td class="text-center">
										@if($producto->band == "activo")
												<span class="badge badge-success">
													{{ ucwords($producto->band) }}
												</span>
											@else
												<span class="badge badge-danger">
												{{ ucwords($producto->band) }}
												</span>
										@endif

									</td>
                                    <td style="width: 10px">
                                        {!! Form::open(['route' => ['productos.destroy', $producto->id], 'method' => 'DELETE']) !!}
                                        <div class="btn-group">
                                            {{--<a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                                <i class="fas fa-eye"></i></a>--}}
                                            {{--<a href="{{ route('productos.show', $producto->id) }}" class="btn btn-default btn-sm" title="Ver">
                                                <i class="fas fa-cog"></i></a>--}}
											@if($producto->band == "activo")
													<a href="{{ route('productos.show', $producto->id) }}" class="btn btn-default btn-sm text-fuchsia" title="Inactivar">
													<i class="fas fa-ban"></i></a>
												@else
													<a href="{{ route('productos.show', $producto->id) }}" class="btn btn-default btn-sm text-success" title="Activar">
													<i class="fas fa-check"></i></a>
											@endif

                                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                                <i class="fas fa-pencil-alt"></i></a>
                                            @if(auth()->user()->type == "Administrador")
                                            <button type="submit" onclick="return confirm('Desea Eliminar al Rubro {{ $producto->nombre }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                                <i class="far fa-trash-alt"></i></button>
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
                        {!! $productos->render() !!}
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


