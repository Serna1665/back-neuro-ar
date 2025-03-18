<?php

use App\Http\Modules\Permisos\Controllers\PermisosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/permisos/crear', [PermisosController::class, 'crearPermisos']);
    Route::post('/permisos/asignar-permiso-role', [PermisosController::class, 'AsignarPermisoRole']);
    Route::post('/permisos/asignar-permiso-usuario', [PermisosController::class, 'asignarPermisoAusuario']);
});
