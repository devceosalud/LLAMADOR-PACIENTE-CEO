<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre')->nullable();
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();

            $table->string('nombre_doctor')->nullable();

            $table->enum('estado_cita', [
                'PROGRAMADO',   //programado la cita en la bd
                'CONFIRMADO',   //confirmo su cita 
                'PACIENTE_LLEGO',
                'EN_ESPERA',    // en espera 
                'LLAMANDO',     // cuando lo llaman 
                'EN_ATENCION',  // en consultorio (llamado del paciente)
                'ATENDIDO',     //se atendio 
                'REEVALUACION',
                'CANCELADO',    //cancelo su cita
                'NO_ASISTIO'    //no vino
            ])->default('PROGRAMADO');

            $table->date('fecha_cita')->nullable();
            $table->time('hora_cita')->nullable();
            $table->timestamp('hora_llegada')->nullable(); //cuando recepcion da click al boton
            $table->timestamp('hora_llamado')->nullable(); //cuando medico llamada al paciente
            $table->timestamp('hora_atencion')->nullable();//cuando medico da click a consultorio
            $table->timestamp('hora_atendido')->nullable();//cuando medico da click a atentido
            $table->text('motivo_consulta')->nullable();
            $table->text('observaciones')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->unsignedTinyInteger('turno_cita')->nullable();
            $table->string('especialidad')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
