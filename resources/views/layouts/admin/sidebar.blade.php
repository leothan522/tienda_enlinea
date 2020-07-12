<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            {{--<li class="nav-item">
                <a href="{{ route('noticias.index') }}" class="nav-link @yield('noticias')">
                    <i class="nav-icon far fa-bookmark"></i>
                    <p>
                        Noticias
                        --}}{{--<span class="right badge badge-danger">New</span>--}}{{--
                    </p>
                </a>
            </li>--}}
            @if(auth()->user()->type == "Administrador")
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cog text-danger"></i>
                    <p class="text-danger">
                        Administrador
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('usuarios.index') }}" class="nav-link @yield('usuarios')">
                            <i class="nav-icon fas fa-users text-primary"></i>
                            <p class="text-primary">
                                Usuarios
                                {{--<span class="right badge badge-danger">New</span>--}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('import.index') }}" class="nav-link @yield('import')">
                            <i class="nav-icon far fa-file-excel text-primary"></i>
                            <p class="text-primary">
                                Import
                                {{--<span class="right badge badge-danger">New</span>--}}
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

            @endif
            <li class="nav-item">
                <a href="{{ route('pedidos.index') }}" class="nav-link @yield('pedidos')">
                    <i class="nav-icon fas fa-shopping-cart text-lime"></i>
                    <p class="text-lime">
                        Pedidos
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            @if(config('app.pagina_web'))
            <li class="nav-item">
                <a href="{{ route('ventas.index') }}" class="nav-link @yield('web')">
                    <i class="nav-icon far fa-envelope text-warning"></i>
                    <p class="text-warning">
                        Ventas Web
                        {{--<span class="right badge badge-danger">New</span>--}}
                    </p>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('clientes.index') }}" class="nav-link @yield('clientes')">
                    <i class="nav-icon fas fa-users text-maroon"></i>
                    <p class="text-maroon">
                        Clientes
                        {{--<span class="right badge badge-danger">08</span>--}}
                    </p>
                </a>
            </li>
            @if(config('app.cne'))
            <li class="nav-item">
                <a href="{{ route('cne.index') }}" class="nav-link @yield('cne')" target="_blank">
                    <i class="nav-icon fas fa-chart-pie text-lightblue"></i>
                    <p class="text-lightblue">
                        Registro CNE
                        {{--<span class="right badge badge-danger">08</span>--}}
                    </p>
                </a>
            </li>
            @endif
            {{--<li class="nav-header">MULTI LEVEL EXAMPLE</li>--}}
            {{--<li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li>--}}
            {{--<li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Administrar Eventos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Eventos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Pagos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Configuración</p>
                        </a>
                    </li>
                </ul>
            </li>--}}
            {{--<li class="nav-header">LABELS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    <p class="text">Important</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>Warning</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>Informational</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Simple Link
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>--}}
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
