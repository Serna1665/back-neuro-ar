<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Modules\Pacientes\Models\Pacientes;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ver-imagen-usuario/{id}', function ($id) {
    $response = Http::withHeaders([
        'Content-Type' => 'application/json'
    ])->post('https://imagenes.neuroar.com.co/saludo', [
        'clave_secreta' => 'shrek',
        'user_id' => (int) $id
    ]);

    if ($response->successful()) {
        return response()->json([
            'imagen_url' => $response['imagen']
        ]);
    } else {
        return response()->json([
            'error' => 'No se pudo obtener la imagen'
        ], $response->status());
    }
});

Route::get('/ver-imagen-paciente/{id}', function ($id) {
    $response = Http::withHeaders([
        'Content-Type' => 'application/json',
    ])->post('https://imagenes.neuroar.com.co/saludo', [
        'clave_secreta' => 'shrek',
        'user_id' => (int) $id,
    ]);

    if ($response->successful()) {
        return response()->json([
            'imagen_url' => $response['imagen'],
        ]);
    } else {
        return response()->json([
            'error' => 'No se pudo obtener la imagen del paciente',
        ], $response->status());
    }
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/validar-email', [AuthController::class, 'validarEmail']);
Route::post('/validar-email', [AuthController::class, 'validarEmail']);

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

