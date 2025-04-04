<?php

use App\Http\Modules\Empresas\Controllers\EmpresaController;
use Illuminate\Support\Facades\Route;

Route::get('/empresas/listarActivas', [EmpresaController::class, 'listarActivas']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/empresas/crear-empresa', [EmpresaController::class, 'crearEmpresas']);
    Route::put('/empresas/actualizar-empresa/{id}', [EmpresaController::class, 'actualizarEmpresa']);
    Route::delete('/empresas/eliminar-empresa/{id}', [EmpresaController::class, 'eliminarEmpresa']);
    Route::get('/empresas/listarTodas', [EmpresaController::class, 'listarTodas']);
    Route::put('/empresas/cambiar-estado/{id}', [EmpresaController::class, 'cambiarEstadoEmpresa']);

});
