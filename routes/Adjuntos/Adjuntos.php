<?php

use App\Http\Modules\Adjuntos\Controller\AdjuntosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/adjuntos/crear', [AdjuntosController::class, 'crear']);
    Route::get('/adjuntos/adjuntos-paciente/{paciente_id}', [AdjuntosController::class, 'adjuntosPaciente']);
    Route::get('/adjuntos/descarga-adjunto/{id}', [AdjuntosController::class, 'descargarAdjunto']);
});
