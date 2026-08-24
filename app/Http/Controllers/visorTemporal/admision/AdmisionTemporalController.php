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
            'NO_ASISTIO',
            'ATENDIDO',
        ])
            ->orderBy('hora_llegada', 'ASC')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();


        return view('visorTemporal.admision.index', [
            'appointments' => $appointments
        ]);
    }


    //ACTUALIZACION DEL BOTON "Llamar" PARA EL LLAMADO
    public function llamar(Request $request)
    {
        // 1. Mapeo de estados y sus respectivas columnas de tiempo
        $columnasPorEstado = [
            'PACIENTE_LLEGO' => ['hora_llegada'],
            'EN_ATENCION'    => ['hora_atencion'],
            'LLAMANDO'       => ['hora_llamado', 'updated_at'],
            'ATENDIDO'       => ['hora_atendido'],
        ];

        $estado = $request->estado_cita;

        // 2. Validación: Si el estado no está en el mapa, termina temprano
        if (!array_key_exists($estado, $columnasPorEstado)) {
            return response()->json(['code' => 0, 'msg' => 'Estado de cita no válido']);
        }

        // 3. Preparar los datos para la actualización masiva
        $datosActualizar = ['estado_cita' => $estado];
        $tiempoSuma = now()->addSeconds(2);

        foreach ($columnasPorEstado[$estado] as $columna) {
            $datosActualizar[$columna] = $tiempoSuma;
        }

        // 4. Una única consulta a la base de datos
        $actualizado = Appointment::where('id', $request->id)->update($datosActualizar);

        // 5. Respuesta simplificada utilizando conversión booleana
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
