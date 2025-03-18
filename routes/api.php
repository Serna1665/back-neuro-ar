<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/validar-email', [AuthController::class, 'validarEmail']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
});

foreach (glob(__DIR__ . '/Pacientes/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/Roles/*.php') as $filename) {
    require_once $filename;
}
foreach (glob(__DIR__ . '/Permisos/*.php') as $filename) {
    require_once $filename;
}
