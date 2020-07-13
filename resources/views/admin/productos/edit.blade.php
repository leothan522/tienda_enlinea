@extends("layouts.admin.layout")
@section('title', 'Productos | Editar')
@section('productos', 'active')
@section('container-title', 'Productos')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos Registrados</a></li>
    <li class="breadcrumb-item active">Editar Producto</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">

            {!! Form::open(['route' => ['productos.update', $producto->id], 'method' => 'PUT']) !!}

            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Producto</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre del Rubro</label>
                                {!! Form::text('nombre', $producto->nombre, ['class' => 'form-control', 'placeholder' => 'Nombre Completo',
                                                'required']) !!}
                            </div>
                            <div class="form-group">
                                <label>Precio de Venta</label>
                                {!! Form::number('precio', $producto->precio, ['class' => 'form-control', 'placeholder' => 'Cantidad',
                                                    'min' => 1, 'pattern' => "^[0-9]+", 'step' => 'any', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="type">Modalidad</label>
                                {!! Form::select('modalidad', ['llamada' => 'Arma tu combo', 'pagina' => 'Pagina Web'], $producto->modalidad,
                                                    ['class' => 'form-control']) !!}
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Guardar" class="btn btn-primary float-right">
                </div>
            </div>
            <br>

            {!! Form::close() !!}




        </div>
    </div>
@endsection

@section('script')
    <script>
        $('[data-mask]').inputmask()
    </script>
@endsection


