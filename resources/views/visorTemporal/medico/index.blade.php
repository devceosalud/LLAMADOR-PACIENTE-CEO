@extends('layouts.app')


@section('css_data_temporal')
    <link rel="stylesheet" type="text/css" href="{{ asset('temporal/css/admision/main.csss') }}" media="screen" />
@endsection

<style>
    :root {
        --primary: #007bff;
        --success: #28a745;
        --warning: #ffc107;
        --danger: #dc3545;
        --dark: #343a40;
        --light: #f8f9fa;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
    }

    body {
        background: var(--light);
        color: var(--dark);
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Info del Médico */
    .doctor-header {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Grid de Trabajo */
    .panel-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    /* Tarjeta Paciente Actual */
    .card {
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card h3 {
        margin-bottom: 15px;
        color: var(--primary);
        border-bottom: 2px solid var(--light);
        padding-bottom: 10px;
    }

    .patient-focus {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #111;
    }

    .meta-info {
        margin-bottom: 20px;
        font-size: 1rem;
        color: #6c757d;
    }

    /* Botonera de flujo de estados */
    .actions-btn {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 20px;
    }

    .btn {
        padding: 15px;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        color: white;
        text-align: center;
        text-transform: uppercase;
    }

    .btn-call {
        background-color: var(--warning);
        color: #212529;
    }

    .btn-attend {
        background-color: var(--primary);
    }

    .btn-finish {
        background-color: var(--success);
    }

    .btn-reeval {
        background-color: #17a2b8;
    }

    /* Lista lateral de Pacientes por Atender hoy */
    .patient-list {
        list-style: none;
    }

    .patient-row {
        display: flex;
        justify-content: space-between;
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
        font-size: 0.95rem;
    }

    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: bold;
        color: #fff;
    }

    .badge-waiting {
        background: var(--primary);
    }

    .badge-arrived {
        background: #6f42c1;
    }
</style>
@section('main_temporal')

    <body>

        <div class="container">
            <div class="doctor-header">
                <div>
                    <h2>Profesional de la Salud</h2>
                    <p style="color: #6c757d;">Lista de atención</p>
                </div>
                <div style="text-align: right;">
                    <strong>Fecha:</strong> 12/09/2026
                    <a class="btn-sm btn-warning" href="{{ route('doctor.temporal.index') }}">Traer Datos</a>
                </div>
            </div>

            {{-- COMPONENTES --}}
        </div>

        {{--
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
        --}}



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
