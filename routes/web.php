<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/saludo', function (Request $request) {
    return response()->json(['imagen' => 'http://srv743319.hstgr.cloud:8000/static/visualizacion_usuario_13.png']);
});
