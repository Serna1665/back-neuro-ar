<?php

use App\Http\Modules\Municipios\Controllers\MunicipioController;
use Illuminate\Support\Facades\Route;

Route::get('/municipios/listar', [MunicipioController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
});
