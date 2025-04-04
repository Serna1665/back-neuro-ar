<?php

namespace App\Http\Modules\Estados\Controller;

use App\Http\Controllers\Controller;
use App\Http\Modules\Estados\Service\EstadoService;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function __construct(
        protected EstadoService $estadoService,
    ) {}

    public function listar()
    {
        try {
            $estados = $this->estadoService->listar();
            return response()->json($estados);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
