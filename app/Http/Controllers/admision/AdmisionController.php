<?php

namespace App\Http\Controllers\admision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class AdmisionController extends Controller
{
    //

    public function __construct() {}

    //TABLA DE DATOS PARA ADMISION
    public function index()
    {

        //LISTA DE PACIENTES CON SUS CITAS MEDICAS 
        $rango = Date("Y-m");
        $appointments = DB::connection('other_system')
            ->table('appointments')
            ->leftJoin('patients', 'patients.id', '=', 'appointments.patient_id')
            ->leftJoin('services', 'services.id', '=', 'appointments.service_id')
            ->leftJoin('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->select(
                'patients.nombre',
                'patients.apellido_paterno',
                'patients.apellido_materno',
                'appointments.id',
                'appointments.duracion_cita',
                'appointments.estado_cita',
                'appointments.turno_cita',
                'services.nombre as NOMBRE_SERVICIO',
                'doctors.nombre as NOMBRE_DOCTOR'
            )
            ->whereNotIn('appointments.estado_cita', ['ATENDIDO'])
            ->where('fecha_cita', 'LIKE', "%$rango%")->get();

        //dd($appointments);
        return view('admision.index', [
            'appointments' => $appointments
        ]);
    }

    //ACTUALIZACION DEL MOODAL DE LOS ESTADOS DE LA CITA
    public function update(Request $request)
    {
        //dd($request->all());
        $appointments = DB::connection('other_system')
            ->table('appointments')
            ->where('id', $request->appointment_id)
            ->update([
                'estado_cita' => $request->estado_cita
            ]);

        if ($appointments) {
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    //ACTUALIZACION DEL BOTON "Llamar" PARA EL LLAMADO
    public function llamar(Request $request)
    {
        $appointment = DB::connection('other_system')
            ->table('appointments')
            ->where('id', $request->id)
            ->update([
                'estado_cita' => 'LLAMANDO',
                'updated_at' => now()->addSeconds(2) //PARA DIFERENCIAR EL UTLIMO LLAMADO
            ]);

        if ($appointment || $appointment === 0) {
            return response()->json([
                'code' => 1,
                'msg' => 'Paciente llamado'
            ]);
        }

        return response()->json([
            'code' => 0,
            'msg' => 'No se pudo llamar'
        ]);
    }


    public function asignarTurno(Request $request) {}
}
