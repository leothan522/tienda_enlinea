<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>@yield("container-title", '@section(\'container-title\')')</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                @yield("breadcrumb", '@section(\'breadcrumb\')')
                {{--
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Legacy User Menu</li>
                --}}
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
