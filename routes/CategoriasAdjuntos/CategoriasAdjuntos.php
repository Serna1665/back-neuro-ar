<?php

use App\Http\Modules\CategoriasAdjuntos\Controller\CategoriasAdjuntosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categorias-adjuntos/crear', [CategoriasAdjuntosController::class, 'crear']);
    Route::get('/categorias-adjuntos/listar', [CategoriasAdjuntosController::class, 'listar']);
    Route::put('/categorias-adjuntos/actualizar/{id}', [CategoriasAdjuntosController::class, 'actualizar']);
});
