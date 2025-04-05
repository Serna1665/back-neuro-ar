<?php

use Illuminate\Support\Facades\Route;
use App\Http\Modules\Oficios\Controllers\OficioController;

Route::get('/oficios/listar', [OficioController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/oficios/crear-oficio', [OficioController::class, 'crearOficios']);
    Route::put('/oficios/actualizar-oficio/{id}', [OficioController::class, 'actualizarOficio']);
    Route::delete('/oficios/eliminar-oficio/{id}', [OficioController::class, 'eliminarOficio']);
    Route::get('/oficios/buscar', [OficioController::class, 'buscar']);
});
