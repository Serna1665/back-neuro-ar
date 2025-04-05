<?php

namespace App\Http\Modules\Dependencias\Controller;

use App\Http\Controllers\Controller;
use App\Http\Modules\Dependencias\Requests\CrearDependenciasRequest;
use App\Http\Modules\Dependencias\Service\DependenciasService;
use Illuminate\Http\Request;

class DependenciasController extends Controller
{
    public function __construct(
        protected DependenciasService $sedesService,
    ) {}

    public function crear(CrearDependenciasRequest $request)
    {
        try {
            $dependencia = $this->sedesService->crear($request->validated());
            return response()->json($dependencia);
        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function listar()
    {
        try {
            $dependencias = $this->sedesService->listar();
            return response()->json($dependencias);
        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    public function listarDependenciasActivas()
    {
        try {
            $dependencias = $this->sedesService->listarDependenciasActivas();
            return response()->json($dependencias);
        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function actualizar($id, CrearDependenciasRequest $request)
    {
        try {
            $dependencia = $this->sedesService->actualizar($id, $request->validated());
            return response()->json($dependencia);
        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function cambiarEstado($id)
    {
        try {
            $dependencia = $this->sedesService->cambiarEstado($id);
            return response()->json($dependencia);
        } catch (\Throwable $th) {
           return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
