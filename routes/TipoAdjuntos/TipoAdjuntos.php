<?php

use App\Http\Modules\TipoAdjuntos\Controller\TipoAdjuntosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tipo-adjuntos/crear', [TipoAdjuntosController::class, 'crear']);
    Route::get('/tipo-adjuntos/listar', [TipoAdjuntosController::class, 'listar']);
    Route::get('/tipo-adjuntos/listar-por-categoria/{categoria_id}', [TipoAdjuntosController::class, 'listarPorCategoria']);
    Route::put('/tipo-adjuntos/actualizar/{id}', [TipoAdjuntosController::class, 'actualizar']);
});
