<div class="grid" id="container">

    @foreach ($appointments as $index => $appointment)
        @php
            $i = 1;
            $estado_cita = [//ESTADOS DE LA CITA
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

            $tiempos = ['CX' => 20, 'consulta' => 20, 'dolor' => 20, 'examen' => 15, 'cambio' => 15];
            $time = $tiempos[$appointment->motivo_consulta] ?? 15;

            // Hora de inicio según el estado, para el contador
            $horaInicio = match ($appointment->estado_cita) {
                'PACIENTE_LLEGO' => $appointment->hora_llegada, //CUANDO ADMISION DA CLICK A PACIENTE_LLEGO
                'LLAMANDO' => $appointment->hora_llamado, //LLAMADO O RELLAMADO
                'EN_ATENCION' => $appointment->hora_atencion, //CUANDO MEDICO DA CLICK A CONSULTORIO
                default => null,
            };
        @endphp

        <div class="card">
            <div>
                <span style="font-size:20px; font-weight:bold;"> #PAC
                </span>
                <br><span class="status-tag"></span>
            </div>

            <div>
                <strong style="font-size:16px;"> {{ $appointment->nombre }} </strong><br>
                <span style="font-size:13px;"> {{ $appointment->motivo_consulta }} </span>
            </div>

            <div class="wait">
                <span class="num">{{ $time }} min</span>
                @if ($horaInicio)
                    <span class="label contador" data-hora-llamado="{{ $horaInicio }}"
                        data-tiempo="{{ $time }}">
                        Cargando...
                    </span>
                @else
                    <span class="label">{{ $estado }}</span>
                @endif
            </div>

            <div>
                <span class="badge"> {{ $estado }} </span>
            </div>

            <div class="actions">
                @if (auth()->user()->name === 'admision')
                    @if ($appointment->estado_cita == 'PROGRAMADO')
                        {{-- DEBEMOS LLAMAR --}}
                        <button class="btn-sm btn-warning llamar-paciente" data-id="{{ $appointment->id }}"
                            data-estado="PACIENTE_LLEGO">
                            PACIENTE LLEGO</button>
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
                @else
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
                @endif


            </div>
        </div>
    @endforeach
</div>
