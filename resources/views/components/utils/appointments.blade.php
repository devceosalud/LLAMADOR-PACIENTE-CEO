<div class="grid" id="container">

    {{--
    @foreach ($appointments as $index => $appointment)
        @php
            $index = $index + 1;
            $estado_cita = [
                //ESTADOS DE LA CITA
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

            // devuelve la hora de inicio según el estado, para el contador
            $horaInicio = match ($appointment->estado_cita) {
                'PACIENTE_LLEGO' => $appointment->hora_llegada, //CUANDO ADMISION DA CLICK A PACIENTE_LLEGO
                'LLAMANDO' => $appointment->hora_llamado, //LLAMADO O RELLAMADO
                'EN_ATENCION' => $appointment->hora_atencion, //CUANDO MEDICO DA CLICK A CONSULTORIO
                default => null,
            };
        @endphp

        <div class="card">
            <div>
                <span style="font-size:20px; font-weight:bold;">
                    {{ $index }} PAC
                </span>
            </div>

            <div>
                <strong style="font-size:16px;"> {{ $appointment->nombre }} </strong><br>
            </div>

            <div>
                <span style="font-size:13px;"> {{ $appointment->motivo_consulta }} <strong
                        class="num">({{ $time }} min)</strong></span>
            </div>

            <div class="wait">
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
                        {{-- DEBEMOS LLAMAR 
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
                        {{-- DEBEMOS LLAMAR 
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
    --}}

    @foreach ($appointments as $index => $appointment)
        @php
            $index = $index + 1;
            $estado_cita = [
                //ESTADOS DE LA CITA
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

            // devuelve la hora de inicio según el estado, para el contador
            $horaInicio = match ($appointment->estado_cita) {
                'PACIENTE_LLEGO' => $appointment->hora_llegada, //CUANDO ADMISION DA CLICK A PACIENTE_LLEGO
                'LLAMANDO' => $appointment->hora_llamado, //LLAMADO O RELLAMADO
                'EN_ATENCION' => $appointment->hora_atencion, //CUANDO MEDICO DA CLICK A CONSULTORIO
                default => null,
            };
        @endphp

        <div class="panel-grid">
            <!-- PACIENTE EN ATENCIÓN / LLAMADO -->
            <div class="card">
                <h3>Paciente en Panel de Control</h3>
                <div class="patient-focus"> {{ $appointment->nombre }} </div>
                <div class="meta-info">
                    <p><strong>Motivo de Consulta:</strong> {{ $appointment->motivo_consulta }}</p>
                    <p style="margin-top: 10px;">
                        <strong>Observaciones previas:</strong>
                        {{ $appointment->observaciones ?? 'Sin datos previos' }}
                    </p>
                    <p><strong>Estado: </strong> {{ $estado }} </p>
                    <div class="wait" style="margin-top: 15px">
                        @if ($horaInicio)
                            <span class="label contador" data-hora-llamado="{{ $horaInicio }}"
                                data-tiempo="{{ $time }}">
                                Cargando...
                            </span>
                        @else
                            <span class="label">{{ $estado }}</span>
                        @endif
                    </div>
                </div>

                <hr>

                <h4 style="margin-top: 15px;">Acciones de Estado (Cambiar Cita):</h4>

                <div class="actions-btn">
                    @if (auth()->user()->name === 'admision')
                        @if ($appointment->estado_cita == 'PROGRAMADO')
                            {{-- DEBEMOS LLAMAR --}}
                            <button class="btn-sm btn-warning llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="PACIENTE_LLEGO">
                                📞 PACIENTE LLEGO</button>
                        @else
                            <button class="btn btn-call paciente llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="LLAMANDO">🔔 RELLAMAR
                                PACIENTE</button>
                            <button class="btn btn-attend llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="EN_ATENCION">🚪 INGRESÓ
                                A CONSULTORIO</button>
                            <button class="btn btn-finish llamar-paciente" style="grid-column: span 2;"
                                data-id="{{ $appointment->id }}" data-estado="ATENDIDO">✅ TERMINAR ATENCIÓ</button>
                            <button class="btn btn-reeval llamar-paciente" style="grid-column: span 2;"
                                data-id="{{ $appointment->id }}" data-estado="REEVALUACION">🔄 ENVIAR A
                                REEVALUACIÓN</button>
                        @endif
                    @else
                        @if ($appointment->estado_cita == 'PROGRAMADO' || $appointment->estado_cita == 'PACIENTE_LLEGO')
                            {{-- DEBEMOS LLAMAR --}}
                            <button class="btn btn-call paciente llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="LLAMANDO">🔔 LLAMAR
                                PACIENTE</button>
                        @else
                            <button class="btn btn-call paciente llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="LLAMANDO">🔔 RELLAMAR
                                PACIENTE</button>
                            <button class="btn btn-attend llamar-paciente" data-id="{{ $appointment->id }}"
                                data-estado="EN_ATENCION">🚪 INGRESÓ
                                A CONSULTORIO</button>
                            <button class="btn btn-finish llamar-paciente" style="grid-column: span 2;"
                                data-id="{{ $appointment->id }}" data-estado="ATENDIDO">✅ TERMINAR ATENCIÓ</button>
                            <button class="btn btn-reeval llamar-paciente" style="grid-column: span 2;"
                                data-id="{{ $appointment->id }}" data-estado="REEVALUACION">🔄 ENVIAR A
                                REEVALUACIÓN</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <!-- SIGUIENTES PACIENTES DEL DOCTOR -->
    <div class="card">
        <h3>Siguientes en Espera</h3>
        <ul class="patient-list">
            <li class="patient-row">
                <div><strong>Ana Gómez S.</strong><br><small>Turno: 12 - 10:30 AM</small></div>
                <div><span class="badge badge-waiting">EN_ESPERA</span></div>
            </li>
            <li class="patient-row">
                <div><strong>Juan Pérez M.</strong><br><small>Turno: 13 - 11:00 AM</small></div>
                <div><span class="badge badge-arrived">PACIENTE_LLEGO</span></div>
            </li>
        </ul>
    </div>


</div>
