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
        <!-- Main Content -->
        <div class="adminx-content">
            <div class="adminx-main-content">
                <div class="container-fluid">
                    <!-- BreadCrumb -->
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb adminx-page-breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Gestión</a></li>
                            <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
                            <li class="breadcrumb-item active  aria-current="page">LLamado</li>
                        </ol>
                    </nav>

                    <div class="pb-3">
                        <h1>Pacientes de hoy </h1>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card mb-grid">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="card-header-title">Tabla</div>
                                </div>
                                <div class="table-responsive-md">
                                    <table class="table table-actions table-striped table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    <label class="custom-control custom-checkbox m-0 p-0">
                                                        <input type="checkbox"
                                                            class="custom-control-input table-select-all">
                                                        <span class="custom-control-indicator"></span>
                                                    </label>
                                                </th>
                                                <th scope="col">Nombres</th>
                                                <th scope="col">Apellidos</th>
                                                <th scope="col">Estado Cita</th>
                                                <th scope="col">Profesional</th>
                                                <th scope="col">Duración</th>
                                                <th scope="col">Turno Asignado</th>
                                                <th scope="col">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($appointments as $appointment)
                                                <tr>
                                                    <th scope="row">
                                                        <label class="custom-control custom-checkbox m-0 p-0">
                                                            <input type="checkbox"
                                                                class="custom-control-input table-select-row">
                                                            <span class="custom-control-indicator"></span>
                                                        </label>
                                                    </th>
                                                    <td>{{ $appointment->nombre }}</td>
                                                    <td>
                                                        {{ $appointment->apellido_paterno }}
                                                        {{ $appointment->apellido_materno }}
                                                    </td>
                                                    <td>{{ $appointment->estado_cita }}</td>
                                                    <td>{{ $appointment->NOMBRE_DOCTOR }}</td>
                                                    <td>
                                                        <span class="badge badge-pill badge-primary">
                                                            {{ $appointment->duracion_cita }} min </span>
                                                    </td>
                                                    <td>{{ $appointment->turno_cita }}</td>
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#estadoCita-{{ $appointment->id }}">
                                                            Estado
                                                        </button>
                                                        <button class="btn btn-sm btn-danger llamar-paciente"
                                                            data-id="{{ $appointment->id }}">Llamar</button>
                                                    </td>
                                                </tr>

                                                @include('admision.modal.estado-cita')
                                            @endforeach


                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- // Main Content -->

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
