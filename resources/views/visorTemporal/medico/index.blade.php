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
                <a href="{{ route('doctor.temporal.index') }}" class="btn-sm btn-success">🔄 Actualizar</a>
            </div>
        </header>

        <div class="grid" id="container">

            @foreach ($appointments as $appointment)
                <div class="card">
                    <div>
                        <span style="font-size:20px; font-weight:bold; color:var(--sub);"> #{{ $appointment->id }}
                        </span>
                        <br><span class="status-tag"></span>
                    </div>
                    <div>
                        <strong style="font-size:16px;"> {{ $appointment->nombre }} </strong><br>
                        <span style="font-size:13px; color:var(--sub);"> {{ $appointment->motivo_consulta }} </span>
                    </div>
                    <div class="time-info">
                        Esp. Est: <strong>tiempo espera min</strong><br>
                        <span style="color:${esExcedido ? 'var(--danger)' : 'var(--accent)'}">En cons: <strong>12
                                min</strong></span>
                    </div>
                    <div>
                        <span class="badge"> {{ $appointment->estado_cita }} </span>
                    </div>
                    <div>
                        <label style="font-size:11px; color:var(--sub);">Orden Manual:</label><br>
                        <input type="number" style="width:60px;" value="">
                    </div>
                    <div class="actions">

                        @if ($appointment->estado_cita == 'PROGRAMADO' || $appointment->estado_cita == 'PACIENTE_LLEGO')
                            {{-- DEBEMOS LLAMAR --}}
                            <button class="btn-sm btn-warning llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="LLAMANDO">▶
                                Consultorio</button>
                        @else
                            <button class="btn-sm btn-voz paciente llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="LLAMANDO">🔊 Rellamar</button>
                            <button class="btn-sm btn-danger llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="EN_ATENCION">En consultorio</button>
                            <button class="btn-sm btn-success llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="ATENDIDO">✓ Atendido</button>
                            <button class="btn-sm btn-warning llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="REEVALUACION">↩ Reevaluación</button>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>

    @section('script_data')
        <script src="{{ asset('temporal/js/admision/gestion.js') }}"></script>
    @endsection
</body>
@endsection
