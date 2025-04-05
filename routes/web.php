<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Modules\Pacientes\Models\Pacientes;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/saludo', function (Request $request) {
    $pacienteId = $request->input('paciente_id');

    $paciente = Pacientes::find($pacienteId);

    if (!$paciente || !$paciente->user_id) {
        return response()->json(['error' => 'Paciente no encontrado o sin user_id'], 404);
    }

    $userId = $paciente->user_id;

    $url = "http://srv743319.hstgr.cloud:8000/static/visualizacion_usuario_{$userId}.png";

    return response()->json(['imagen' => $url]);
});
