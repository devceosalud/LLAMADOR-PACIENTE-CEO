<?php

use App\Http\Controllers\admision\AdmisionController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\visor\VisorController;
use App\Http\Controllers\visorTemporal\admision\AdmisionTemporalController;
use App\Http\Controllers\visorTemporal\doctor\DoctorTemporalController;
use App\Http\Controllers\visorTemporal\visor\VisorTemporalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
}); */



Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login/store', [AuthController::class , 'store'])->name('login.store');


Route::get('/admision/gestion-paciente', [AdmisionController::class, 'index'])->name('admision.index');
Route::put('/admision/gestion-paciente/estado', [AdmisionController::class, 'update'])->name('admision.update');
Route::post('/llamar-paciente', [AdmisionController::class , 'llamar'])->name('admision.llamar');

Route::get('/home/llamador', [VisorController::class, 'index'])->name('home');
Route::get('/all-appointment/visor', [VisorController::class, 'allAppointment']);



/**************************************************************************************
 * RUTAS PARA EL VISOR TEMPORAL                                                       *
 **************************************************************************************/
Route::get('/visor/temporal/paciente', [VisorTemporalController::class, 'index'])->name('visor.temporal.index');
Route::get('/all-appointment/visor/temp', [VisorTemporalController::class , 'allAppointment'])->name('allAppointment');


Route::get('/admision/temporal/gestion-paciente', [AdmisionTemporalController::class, 'index'])->name('admision.temporal.index');
Route::post('/llamar-temporal-paciente', [AdmisionTemporalController::class , 'llamar'])->name('admision.temporal.llamar');


Route::get('/doctor/temporal/gestion-paciente', [DoctorTemporalController::class, 'index'])->name('doctor.temporal.index');