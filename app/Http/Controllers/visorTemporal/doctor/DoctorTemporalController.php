<?php

namespace App\Http\Controllers\visorTemporal\doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorTemporalController extends Controller
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
            'PROGRAMADO',
            'CANCELADO',
            'NO_ASISTIO',
            'ATENDIDO',
        ])
            ->orderBy('hora_llegada', 'ASC')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();


        $atendidos = $appointments = Appointment::whereNotIn('estado_cita', [
            'PROGRAMADO',
            'CANCELADO',
            'NO_ASISTIO',
            'ATENDIDO',
        ])
            ->orderBy('hora_llegada', 'ASC')
            ->where('estado_cita', 'ATENDIDO')
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();

        return view('visorTemporal.medico.index', [
            'appointments' => $appointments,
            'atendidos' => $atendidos
        ]);
    }
}
