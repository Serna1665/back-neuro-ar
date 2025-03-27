<?php

use App\Http\Modules\Permisos\Controllers\PermisosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/permisos/crear', [PermisosController::class, 'crearPermisos']);
    Route::post('/permisos/asignar-permiso-role', [PermisosController::class, 'AsignarPermisoRole']);
    Route::post('/permisos/asignar-permiso-usuario', [PermisosController::class, 'asignarPermisoAusuario']);
    Route::get('/permisos/listar', [PermisosController::class, 'listarPermisos']);
    Route::get('/permisos/permisos-usuario/{user_id}', [PermisosController::class, 'listarPermisosDeUsuario']);
    Route::put('/permisos/actualizar/{id}', [PermisosController::class, 'actualizarPermisos']);
    Route::get('/permisos/listar-permiso-role/{id}', [PermisosController::class, 'listarPermisosRol']);
});
