<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'nombre_doctor',
        'estado_cita',
        'fecha_cita',
        'hora_cita',
        'hora_llegada',
        'hora_llamado',
        'hora_atencion',
        'hora_atendido',
        'motivo_consulta',
        'observaciones',
        'fecha_registro',
        'turno_cita',
        'especialidad'
    ];
}
