<?php

use App\Http\Modules\Paises\Controllers\PaisController;
use Illuminate\Support\Facades\Route;

Route::get('/paises/listar', [PaisController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
});
