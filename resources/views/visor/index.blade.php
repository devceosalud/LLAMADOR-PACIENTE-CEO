@extends('layouts.app')



@section('css_data')
    <link rel="stylesheet" type="text/css" href="{{ asset('dist/css/adminx.css') }}" media="screen" />
@endsection


@section('main')
    <div class="adminx-container">
        {{-- Nav --}}
        @include('templates.nav')
        {{-- Nav End --}}

        <!-- expand-hover push -->
        <!-- Sidebar -->
        @include('templates.sidebar')
        <!-- Sidebar End -->

        <!-- adminx-content-aside -->
        <div class="adminx-content">
            <!-- <div class="adminx-aside"></div> -->

            <div class="adminx-main-content">
                <div class="container-fluid">
                    <!-- BreadCrumb -->
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb adminx-page-breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Lista</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Llamador</li>
                        </ol>
                    </nav>

                    <div class="pb-3">
                        <h1>Ceo Salud - Llamado del Paciente - Agosto </h1>
                    </div>

                    <button class="btn btn-primary tts">Iniciar</button>

                    <input type="hidden" name="count-appointment" id="count-appointment" value="1">
                    <div class="row">
                        {{-- LISTA DE LAS CITAS PARA EL LLAMADO --}}
                        <div class="col-md-8">
                            <div id="All-appointment"></div>
                        </div>

                        <div class="col-md-4">
                            <p class="nombre_prueba"></p>
                        </div>
                    </div>

                    <script src="{{ asset('js/visor/visor.js') }}"></script>
                </div>
            </div>
        </div>


    @section('script_data')
        <!-- If you prefer jQuery these are the required scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('dist/js/vendor.js') }}"></script>
        <script src="{{ asset('dist/js/adminx.js') }}"></script>


        <!-- If you prefer vanilla JS these are the only required scripts -->
        <!-- script src="./dist/js/vendor.js"></script>
            <script src="./dist/js/adminx.vanilla.js"></script-->
        <script src="{{ asset('js/admision/admision.js') }}"></script>
    @endsection
</div>
@endsection
