<?php

use App\Http\Modules\Pacientes\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

Route::post('/pacientes/crear', [PacientesController::class, 'CrearPacientes']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pacientes/buscar', [PacientesController::class, 'buscarUsuario']);
    Route::get('/pacientes/datos-paciente/{datosUsuarios}', [PacientesController::class, 'datosPaciente']);
    Route::put('/pacientes/actualizar-informacion', [PacientesController::class, 'actualizarDatos']);
    Route::get('/pacientes-empresa/{user_id}', [PacientesController::class, 'listarPacientesPorEmpresa']);
    Route::get('/pacientes-empresa-desde-user/{user_id}', [PacientesController::class, 'listarPorEmpresaDeUsuario']);
    Route::post('/actualizar-datos-personales', [PacientesController::class, 'actualizarDatosPersonales']);
});
