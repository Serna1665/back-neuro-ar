<?php

use Illuminate\Support\Facades\Route;
use App\Http\Modules\Oficios\Controllers\OficioController;

Route::get('/oficios/listar', [OficioController::class, 'index']);
