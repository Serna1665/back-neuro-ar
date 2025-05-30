<?php

namespace App\Http\Modules\Adjuntos\Controller;

use App\Http\Controllers\Controller;
use App\Http\Modules\Adjuntos\Service\AdjuntosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdjuntosController extends Controller
{
    public function __construct(
        protected AdjuntosService $adjuntosService,
    ) {}

    public function crear(Request $request)
    {
        try {
            $adjuntos = $this->adjuntosService->crear($request);
            return response()->json($adjuntos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function adjuntosPaciente($paciente_id)
    {
        try {
            $adjuntos = $this->adjuntosService->obtenerAdjuntosPorPaciente($paciente_id);
            return response()->json($adjuntos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function descargarAdjunto($id)
    {
        try {
            return $this->adjuntosService->descargarArchivo($id);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function eliminarAdjunto($id)
    {
        try {
            $resultado = $this->adjuntosService->eliminarAdjunto($id);
            return response()->json(['success' => $resultado]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
