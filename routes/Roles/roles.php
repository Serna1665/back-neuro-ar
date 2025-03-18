<?php

use App\Http\Modules\Roles\Controller\RolesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/roles/crear', [RolesController::class, 'crearRoles']);
    Route::post('/roles/asignar-roles', [RolesController::class, 'asignarRole']);
});
