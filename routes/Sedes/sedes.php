<?php

use App\Http\Modules\Sedes\Controller\SedesController;
use Illuminate\Support\Facades\Route;

Route::get('/sedes/listar-dependencias-sede/{id}', [SedesController::class, 'listarDependenciasSede']);
Route::get('/sedes/listar-sede-empresa/{id}', [SedesController::class, 'listarSedesPorEmpresa']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sedes/crear', [SedesController::class, 'crearSedes']);
    Route::get('/sedes/listar', [SedesController::class, 'listarSedes']);
    Route::put('/sedes/actualizar/{id}', [SedesController::class, 'actualizar']);
    Route::post('/sedes/cambiar-estado/{id}', [SedesController::class, 'cambiarEstado']);
    Route::post('/sedes/asignar-dependencias', [SedesController::class, 'asignarDependencias']);
});
