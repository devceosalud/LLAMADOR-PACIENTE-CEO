@forelse ($appointments as $appointment)
    @php
        $estado_cita = [
            'PROGRAMADO' => 'PROGRAMADO',
            'CONFIRMADO' => 'CONFIRMADO',
            'PACIENTE_LLEGO' => 'PACIENTE LLEGO',
            'EN_ESPERA' => 'EN ESPERA',
            'LLAMANDO' => 'LLAMANDO',
            'EN_ATENCION' => 'EN ATENCION',
            'ATENDIDO' => 'ATENDIDO',
            'REEVALUACION' => 'REEVALUACION',
            'CANCELADO' => 'CANCELADO',
            'NO_ASISTIO' => 'NO ASISTIO',
        ];
        $estado = $estado_cita[$appointment->estado_cita] ?? 'SIN ESTADO';

        // Color de la pastilla según el estado (usa las clases .consultorio/.auxiliares/.espera del CSS)
        $pillClass = match ($appointment->estado_cita) {
            'EN_ATENCION' => 'consultorio',
            'LLAMANDO' => 'auxiliares',
            default => 'espera',
        };
    @endphp


    <div class="row {{ $appointment->estado_cita === 'EN_ATENCION' ? 'now' : '' }}">
        <div class="name">{{ $appointment->nombre }} {{ $appointment->apellido_paterno }} </div>
        <div class="status">
            <span class="pill {{ $pillClass }}">
                <span class="beat">{{ $estado }}</span>
            </span>
        </div>
        <div class="ticket">{{ $appointment->especialidad }}</div>
    </div>
@empty
    <div class="empty">
        <span>No hay pacientes en espera</span>
    </div>
@endforelse
