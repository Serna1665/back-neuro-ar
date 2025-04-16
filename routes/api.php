<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\restablecerContrasenaController;
use App\Http\Modules\Pacientes\Models\Pacientes;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/validar-email', [AuthController::class, 'validarEmail']);
Route::post('/recuperar-contrasena', [restablecerContrasenaController::class, 'enviarCorreo']);
Route::post('/validar-token', [restablecerContrasenaController::class, 'validarToken']);
Route::post('/actualizar-contrasena', [restablecerContrasenaController::class, 'actualizarContrasena']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
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

$empresaRoutes = glob(__DIR__ . '/Empresas/*.php');
foreach ($empresaRoutes as $routeFile) {
    require_once $routeFile;
}

foreach (glob(__DIR__ . '/Sedes/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/Estados/*.php') as $filename) {
    require_once $filename;
}

foreach (glob(__DIR__ . '/Dependencias/*.php') as $filename) {
    require_once $filename;
}

