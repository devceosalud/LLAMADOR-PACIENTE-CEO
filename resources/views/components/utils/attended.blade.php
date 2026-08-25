<div class="grid" id="container">

    @foreach ($atendidos as $index => $appointment)
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
                <span style="font-size:13px;"> {{ $appointment->motivo_consulta }} </span>
            </div>

            <div>
                <button class="btn-sm btn-success"> <strong> {{ $estado }}</strong> </button>
            </div>

            <div>
                <span>Cierre: {{ $appointment->hora_atendido }} </span>
            </div>
        </div>
    @endforeach
</div>
