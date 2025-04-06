<?php

use App\Http\Modules\Dependencias\Controller\DependenciasController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/dependencias/crear', [DependenciasController::class, 'crear']);
    Route::get('/dependencias/listar', [DependenciasController::class, 'listar']);
    Route::put('/dependencias/actualizar/{id}', [DependenciasController::class, 'actualizar']);
    Route::post('/dependencias/cambiar-estado/{id}', [DependenciasController::class, 'cambiarEstado']);
    Route::get('/dependencias/listar-dependencias-activas', [DependenciasController::class, 'listarDependenciasActivas']);

});
