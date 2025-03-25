<?php

use App\Http\Modules\Departamentos\Controllers\DepartamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/departamentos/listar', [DepartamentoController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
});
