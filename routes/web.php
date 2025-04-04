<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/saludo', function (Request $request) {
    $userId = $request->input('user_id');

    $url = "http://srv743319.hstgr.cloud:8000/static/visualizacion_usuario_{$userId}.png";

    return response()->json(['imagen' => $url]);
});
