<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield("container-title", '@section(\'container-title\')'){{-- Top Navigation <small>Example 3.0</small>--}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @yield("breadcrumb", '@section(\'breadcrumb\')')
                {{--<li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                <li class="breadcrumb-item active">Top Navigation</li>--}}
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
