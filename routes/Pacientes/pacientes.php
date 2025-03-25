<?php

use App\Http\Modules\Pacientes\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::post('/pacientes/crear', [PacientesController::class, 'CrearPacientes']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pacientes/buscar', [PacientesController::class, 'buscarUsuario']);
    Route::get('/pacientes/datos-paciente/{datosUsuarios}', [PacientesController::class, 'datosPaciente']);
});
