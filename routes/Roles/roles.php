<?php

use App\Http\Modules\Roles\Controller\RolesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/roles/crear', [RolesController::class, 'crearRoles']);
    Route::post('/roles/asignar-roles', [RolesController::class, 'asignarRole']);
    Route::get('/roles/listar', [RolesController::class, 'listar']);
    Route::get('/roles/roles-usuario/{user_id}', [RolesController::class, 'listarRolesUsuario']);
    Route::put('/roles/actualizar/{id}', [RolesController::class, 'actualizar']);
});
