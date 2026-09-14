<?php

namespace App\Http\Controllers\visorTemporal\admision;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdmisionTemporalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //
    public function index()
    {
        //LISTA DE PACIENTES CON SUS CITAS MEDICAS    
        $rango = Date("Y-m-d");

        $appointments = Appointment::whereNotIn('estado_cita', [
            'CANCELADO',
            'REEVALUACION',
            'NO_ASISTIO',
            'ATENDIDO',
        ])
            ->orderByRaw('ISNULL(hora_llegada) ASC')
            ->orderBy('hora_llegada', 'ASC')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();


        $atendidos = Appointment::whereIn('estado_cita', [
            'ATENDIDO',
        ])
            ->orderBy('hora_llegada', 'ASC')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();

        $reevaluaciones = Appointment::whereIn('estado_cita', [
            'REEVALUACION',
        ])
            ->orderBy('hora_llegada', 'ASC')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();

        //dd($appointments);
        return view('visorTemporal.admision.index', [
            'appointments' => $appointments,
            'atendidos' => $atendidos,
            'reevaluaciones' => $reevaluaciones
        ]);
    }


    //ACTUALIZACION DEL BOTON "Llamar" PARA EL LLAMADO
    public function llamar(Request $request)
    {
        /*$esReevaluacion = Appointment::find($request->id);
        if ($esReevaluacion && $esReevaluacion->estado_cita == 'REEVALUACION') { //PARA LLAMADOS DE REEVALUACIONES
            if ($request->estado_cita == 'LLAMANDO') {
                $esReevaluacion->update([
                    'hora_llamado' => now()->addSeconds(2),
                    'updated_at' => now()->addSeconds(2),
                ]);
            }
            return response()->json([
                'code' => 1,
                'msg'  => $esReevaluacion->estado_cita
            ]);
        }*/

        // ESTADOS DE LAS CITAS Y SUS TIEMPO POR ACTUALIZAR O ASIGNAR
        $columnasPorEstado = [
            'PACIENTE_LLEGO' => ['hora_llegada'], //GUARDA FECHA Y HORA
            'EN_ATENCION'    => ['hora_atencion'], //GUARDA FECHA Y HORA
            'LLAMANDO'       => ['hora_llamado', 'updated_at'], //GUARDA FECHA Y HORA
            'ATENDIDO'       => ['hora_atendido'], //GUARDA FECHA Y HORA
            'REEVALUACION'   => ['updated_at'], //GUARDA FECHA Y HORA
        ];

        $estado = $request->estado_cita;

        // VALIDAMOS SI EL ESTADO ESTA EN EL MAPA, SI NO, DAMOS LA ALERTA
        if (!array_key_exists($estado, $columnasPorEstado)) {
            return response()->json(['code' => 0, 'msg' => 'Estado de cita no válido']);
        }

        // PREPARAMOS LA ACTUALIZACION MASIVA POR ESTADO MANDADO POR EL FECTH
        $datosActualizar = ['estado_cita' => $estado];
        $tiempoSuma = now()->addSeconds(2);

        foreach ($columnasPorEstado[$estado] as $columna) { //RECORREMOS LA LISTA
            $datosActualizar[$columna] = $tiempoSuma;
        }

        // CONSULTA A LA BD CON LA LISTA
        $actualizado = Appointment::where('id', $request->id)->update($datosActualizar);

        // MANDAMOS LA ALERTA SI SE ACTUALIZO CORRECTAMENTE
        if ($actualizado) {
            return response()->json([
                'code' => 1,
                'msg'  => $estado
            ]);
        }

        return response()->json([
            'code' => 0,
            'msg'  => 'No se encontró la cita o no hubo cambios'
        ]);
    }
}
