@forelse ($appointments as $appointment)
    @php
        $tiempos = ['CX' => 20, 'consulta' => 20, 'dolor' => 20, 'examen' => 15, 'cambio' => 15];
        $time = $tiempos[$appointment->motivo_consulta] ?? 15;

        // Color de la pastilla según el estado (usa las clases .consultorio/.auxiliares/.espera del CSS)
        $pillClass = match ($appointment->estado_cita) {
            'EN_ATENCION' => 'consultorio',
            'LLAMANDO' => 'auxiliares',
            default => 'espera',
        };

        // Hora de inicio según el estado, para el contador
        $horaInicio = match ($appointment->estado_cita) {
            'LLAMANDO' => $appointment->hora_llamado, //CAMPOS DE HORA DE LLAMADO
            'EN_ATENCION' => $appointment->hora_llamado, //CAMPO DE HORA DE INCIO ATENCION: 'EN_ATENCION' => $appointment->hora_atencion
            default => null,
        };
    @endphp
    <div class="row {{ $appointment->estado_cita === 'EN_ATENCION' ? 'now' : '' }}">
        <div class="ticket">{{ $appointment->id }}</div>
        <div class="name">{{ $appointment->nombre }}</div>
        <div class="status">
            <span class="pill {{ $pillClass }}">
                <span class="beat">{{ $appointment->estado_cita }}</span>
            </span>
        </div>
        <div class="wait">
            <span class="num">{{ $time }} min</span>
            @if ($horaInicio)
                <span class="label contador" data-hora-llamado="{{ $horaInicio }}" data-tiempo="{{ $time }}">
                    Cargando...
                </span>
            @else
                <span class="label">{{ $appointment->estado_cita }}</span>
            @endif
        </div>
    </div>
@empty
    <div class="empty">
        <span>No hay pacientes en espera</span>
    </div>
@endforelse
