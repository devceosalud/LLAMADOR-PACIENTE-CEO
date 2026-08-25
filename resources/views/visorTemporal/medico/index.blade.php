@extends('layouts.app')


@section('css_data_temporal')
    <link rel="stylesheet" type="text/css" href="{{ asset('temporal/css/admision/main.css') }}" media="screen" />
@endsection


@section('main_temporal')

    <body>

        <header>
            <div>
                <h1>Panel de Gestión Operativa - {{ auth()->user()->name }} </h1>
                <span style="color:var(--sub); font-size: 13px;">CEO Salud · Especialidades</span>
            </div>
            <div class="user-selector">
                <label for="currentUser">Usuario: {{ auth()->user()->name }} </label>
                <a style="text-decoration: none" href="{{ route('doctor.temporal.index') }}" class="btn-sm btn-success">🔄
                    Traer Datos</a>
            </div>
        </header>



        {{-- COMPONENTES DE CITAS --}}
        <x-utils.appointments :appointments="$appointments" />
        {{-- COMPONENTES DE CITAS --}}

        <br>
        <hr>

        {{-- COMPONENTES DE CITAS --}}
        <x-utils.attended :atendidos="$atendidos" />
        {{-- COMPONENTES DE CITAS --}}

        <br>
        <hr>

        {{-- COMPONENTES REEVALUACIONES --}}
        <x-utils.reevaluations :reevaluaciones="$reevaluaciones" />
        {{-- COMPONENTES REEVALUACIONES --}}



    @section('script_data')
        <script src="{{ asset('temporal/js/admision/gestion.js') }}"></script>
    @endsection
</body>
@endsection
