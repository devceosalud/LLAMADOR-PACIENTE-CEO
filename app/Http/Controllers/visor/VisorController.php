<?php

namespace App\Http\Controllers\visor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VisorController extends Controller
{
    //

    public function index()
    {
        return view('visor.index');
    }


    //TRAENDO LOS PACIENTE CON EL RANGO DE AÑO/MES/DIA
    public function allAppointment()
    {
        $rango = Date("Y-m");
        //LISTA DE PACIENTES CON SUS CITAS MEDICAS
        $appointments = DB::connection('other_system')
            ->table('appointments')
            ->leftJoin('patients', 'patients.id', '=', 'appointments.patient_id')
            ->leftJoin('services', 'services.id', '=', 'appointments.service_id')
            ->leftJoin('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->select(
                'patients.nombre',
                'patients.apellido_paterno',
                'patients.apellido_materno',
                'appointments.duracion_cita',
                'appointments.estado_cita',
                'appointments.turno_cita',
                'services.nombre as NOMBRE_SERVICIO',
                'doctors.nombre as NOMBRE_DOCTOR'
            )
            ->whereIn('appointments.estado_cita', [
                'PACIENTE_LLEGO',
                'LLAMANDO',
                'REEVALUACION',
                'EN_ESPERA'
            ])
            ->where('fecha_cita', 'LIKE', "%$rango%")
            ->get();


        // PACIENTE QUE SE ESTA LLAMANDO
        $llamando = DB::connection('other_system')
            ->table('appointments')
            ->leftJoin('patients', 'patients.id', '=', 'appointments.patient_id')
            ->leftJoin('services', 'services.id', '=', 'appointments.service_id')
            ->leftJoin('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->select(
                'appointments.id',
                'appointments.updated_at',
                'patients.nombre',
                'patients.apellido_paterno',
                'patients.apellido_materno',
                'services.nombre as NOMBRE_SERVICIO',
                'doctors.nombre as NOMBRE_DOCTOR'
            )
            ->where('appointments.estado_cita', 'LLAMANDO')
            ->orderBy('appointments.updated_at', 'desc')
            ->first();


        $data = view('visor.all-appointment', [
            'appointments' => $appointments
        ])->render();


        return response()->json([
            'code' => 1,
            'result' => $data,
            'llamando' => $llamando
        ]);
    }
}
