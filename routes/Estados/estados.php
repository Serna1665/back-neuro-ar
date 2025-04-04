<?php

use App\Http\Modules\Estados\Controller\EstadosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/estados/listar', [EstadosController::class, 'listar']);
});
