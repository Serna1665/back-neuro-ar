<?php

namespace App\Http\Modules\TipoAdjuntos\Controller;

use App\Http\Controllers\Controller;
use App\Http\Modules\TipoAdjuntos\Service\TipoAdjuntoService;
use Illuminate\Http\Request;

class TipoAdjuntosController extends Controller
{
    public function __construct(
        protected TipoAdjuntoService $tipoAdjuntoService,
    ) {}

    public function crear(Request $request)
    {
        try {
            $tipoAdjunto = $this->tipoAdjuntoService->crear($request->all());
            return response()->json($tipoAdjunto);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function listar()
    {
        try {
            $tipoAdjuntos = $this->tipoAdjuntoService->listar();
            return response()->json($tipoAdjuntos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function actualizar($id, Request $request)
    {
        try {
            $tipoAdjunto = $this->tipoAdjuntoService->actualizar($id, $request->all());
            return response()->json($tipoAdjunto);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function listarPorCategoria(int $categoria_id)
    {
        try {
            $tipoAdjuntos = $this->tipoAdjuntoService->listarPorCategoria($categoria_id);
            return response()->json($tipoAdjuntos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
