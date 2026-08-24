<?php

namespace App\Http\Controllers\visorTemporal\visor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class VisorTemporalController extends Controller
{
    //
    //

    public function index()
    {
        return view('visorTemporal.visor.index');
    }


    //TRAENDO LOS PACIENTE CON EL RANGO DE AÑO/MES/DIA
    public function allAppointment()
    {
        //LISTA DE PACIENTES CON SUS CITAS MEDICAS  UW NO TENGAN ESTE ESTADO , SEREAN VISIBLES   
        $rango = Date("Y-m");
        $appointments = Appointment::whereNotIn('estado_cita', [
            'PROGRAMADO',
            'CANCELADO',
            'NO_ASISTIO',
            'ATENDIDO',
        ])
            ->orderBy('hora_llamado', 'DESC')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();


        // PACIENTE QUE SE ESTA LLAMANDO POR ESE ESTADO
        $llamando = Appointment::where('estado_cita', 'LLAMANDO')
            ->orderBy('appointments.updated_at', 'desc')
            ->first();


        $data = view('visorTemporal.visor.all-appointment', [
            'appointments' => $appointments
        ])->render();


        return response()->json([
            'code' => 1,
            'result' => $data,
            'llamando' => $llamando
        ]);
    }
}
