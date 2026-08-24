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
        $rango = Date("Y-m");
        $appointments = Appointment::whereNotIn('estado_cita', [
            'CANCELADO',
            'NO_ASISTIO',
            'ATENDIDO',
        ])
            ->orderBy('updated_at', 'DESC')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();
        //dd($appointments);

        return view('visorTemporal.admision.index', [
            'appointments' => $appointments
        ]);
    }


    //ACTUALIZACION DEL BOTON "Llamar" PARA EL LLAMADO
    public function llamar(Request $request)
    {
        if ($request->estado_cita == "EN_ATENCION") {
            $appointment = Appointment::where('id', $request->id)
                ->update([
                    'estado_cita' => $request->estado_cita,
                    'hora_llamado' => now()->addSeconds(2) //PARA DIFERENCIAR EL UTLIMO LLAMADO
                ]);
        }
        $appointment = Appointment::where('id', $request->id)
            ->update([
                'estado_cita' => $request->estado_cita,
                'updated_at' => now()->addSeconds(2) //PARA DIFERENCIAR EL UTLIMO LLAMADO
            ]);

        if ($appointment || $appointment === 0) {
            return response()->json([
                'code' => 1,
                'msg' => $request->estado_cita
            ]);
        }

        return response()->json([
            'code' => 0,
            'msg' => 'No se pudo llamar'
        ]);
    }
}
