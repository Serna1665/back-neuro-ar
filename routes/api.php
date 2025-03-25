<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/saludo', function (Request $request) {
    return response()->json(['imagen' => 'http://srv743319.hstgr.cloud:8000/static/visualizacion_usuario_13.png']);
});

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

foreach (glob(__DIR__ . '/Oficios/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/Roles/*.php') as $filename) {
    require_once $filename;
}
foreach (glob(__DIR__ . '/Permisos/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/Paises/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/Municipios/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/Departamentos/*.php') as $filename) {
    require_once $filename;
}
