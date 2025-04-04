<?php

use App\Http\Modules\Empresas\Controllers\EmpresaController;
use Illuminate\Support\Facades\Route;

Route::get('/empresas/listar', [EmpresaController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/empresas/crear-empresa', [EmpresaController::class, 'crearEmpresas']);
    Route::put('/empresas/actualizar-empresa/{id}', [EmpresaController::class, 'actualizarEmpresa']);
    Route::post('/empresas/buscar-empresa', [EmpresaController::class, 'buscarEmpresas']);
});
