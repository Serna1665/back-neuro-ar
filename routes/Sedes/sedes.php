<?php

use App\Http\Modules\Sedes\Controller\SedesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sedes/crear', [SedesController::class, 'crearSedes']);
    Route::get('/sedes/listar', [SedesController::class, 'listarSedes']);
    Route::put('/sedes/actualizar/{id}', [SedesController::class, 'actualizar']);
});
