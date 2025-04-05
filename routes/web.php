<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Modules\Pacientes\Models\Pacientes;

Route::get('/', function () {
    return view('welcome');
});

