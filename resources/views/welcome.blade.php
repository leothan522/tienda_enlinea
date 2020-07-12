@extends("layouts.guest.layout")

@section('container-title')
    @if(config('app.municipio') == 'ROSCIO')
        <span>Juan German Roscio</span>
    @endif
    @if(config('app.municipio') == 'INFANTE')
        <span>Leonardo Infante</span>
    @endif
    @if(config('app.municipio') == 'MIRANDA')
        <span>Francisco de Miranda</span>
    @endif
    @if(config('app.municipio') == 'MONAGAS')
        <span>Jose Tadeos Monagas</span>
    @endif
@endsection

@section('breadcrumb')
    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li>--}}
    {{--<li class="breadcrumb-item active">Noticias</li>--}}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    {{--<h5 class="card-title">Card title</h5>--}}

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item">
                                @if(config('app.municipio') == 'ROSCIO')
                                    <img class="d-block w-100" src="{{ asset('img/carousel/3_roscio.png') }}" alt="First slide">
                                @endif
                                @if(config('app.municipio') == 'INFANTE')
                                    <img class="d-block w-100" src="{{ asset('img/carousel/3_infante.png') }}" alt="First slide">
                                @endif
                                @if(config('app.municipio') == 'MIRANDA')
                                    <img class="d-block w-100" src="{{ asset('img/carousel/3_miranda.png') }}" alt="First slide">
                                @endif
                                @if(config('app.municipio') == 'MONAGAS')
                                    <img class="d-block w-100" src="{{ asset('img/carousel/3_roscio.png') }}" alt="First slide">
                                @endif
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('img/carousel/2.png') }}" alt="Second slide">
                            </div>
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset('img/carousel/1.jpg') }}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    {{--<h5 class="card-title">Card title</h5>--}}
                    @if(config('app.municipio') == 'ROSCIO')
                        <a href="{{ route('login') }}">
                            <img class="img-thumbnail" src="{{ asset('img/carousel/mun_roscio.jpg') }}" alt="Entrar">
                        </a>
                    @endif
                    @if(config('app.municipio') == 'INFANTE')
                        <a href="{{ route('login') }}">
                            <img class="img-thumbnail" src="{{ asset('img/carousel/mun_infante.jpg') }}" alt="Entrar">
                        </a>
                    @endif
                    @if(config('app.municipio') == 'MIRANDA')
                        <a href="{{ route('login') }}">
                            <img class="img-thumbnail" src="{{ asset('img/carousel/mun_miranda.jpg') }}" alt="Entrar">
                        </a>
                    @endif
                    @if(config('app.municipio') == 'MONAGAS')
                        <a href="{{ route('login') }}">
                            <img class="img-thumbnail" src="{{ asset('img/carousel/mun_monagas.jpg') }}" alt="Entrar">
                        </a>
                    @endif
                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->

@endsection
