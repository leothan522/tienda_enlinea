@extends("layouts.admin.layout")
@section('title', 'Usuarios')
@section('usuarios', 'active')
@section('container-title', 'Usuarios')
@section('breadcrumb', '')

@section('buscar')
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="text" placeholder="Buscar Usuario" aria-label="Buscar" required>
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">



            <div class="card">
                <div class="card-header bg-indigo border-0">
                    <h3 class="card-title">Usuarios Registrados</h3>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                        </a>
                        <a href="{{ route('usuarios.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-user-plus"></i>
                        </a>
                        {{--<a href="#" class="btn btn-tool btn-sm">
                            <i class="fas fa-bars"></i>
                        </a>--}}
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                    <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Tipo de Usuario</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $usuario)

                            @if($usuario->user_dato)
                                @php($foto = 'img/users_img/'.$usuario->user_dato->foto)
                            @else
                                @php($foto = 'dist/img/user2-160x160.jpg')
                            @endif

                        <tr class="text-center table-primary text-sm">
                            <td class="text-left">
                                <a href="{{ asset($foto) }}"
                                   data-rel="lightcase" title="{{ $usuario->name }}">
                                    <img src="{{ asset($foto) }}" alt="{{ $usuario->email }}" class="img-circle img-size-32 mr-2">
                                </a>
                                {{ $usuario->name }}
                            </td>
                            <td class="text-left">{{ strtolower($usuario->email) }}</td>
                            <td>{{ $usuario->type }}</td>
                            <td style="width: 10px">
                                {!! Form::open(['route' => ['usuarios.destroy', $usuario->id], 'method' => 'DELETE']) !!}
                                <div class="btn-group">
                                    {{--<a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-default btn-sm text-info" title="Ver">
                                        <i class="fas fa-eye"></i></a>--}}
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-default btn-sm text-warning" title="Editar">
                                        <i class="fas fa-pencil-alt"></i></a>
                                    {{--<a href="#" class="btn btn-default btn-sm" title="Cambiar Tipo">
                                        <i class="fas fa-cog"></i></a>--}}
                                    <button type="submit" onclick="return confirm('Desea Eliminar al Usuario {{ $usuario->name }}')" class="btn btn-default btn-sm text-danger" title="Eliminar">
                                        <i class="far fa-trash-alt"></i></button>
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <div class="row text-sm justify-content-end">
                        {!! $usuarios->render() !!}
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection

@section('script')
    <script>
        jQuery(document).ready(function($) {
            $('a[data-rel^=lightcase]').lightcase();
        });

    </script>
@endsection


