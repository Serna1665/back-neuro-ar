<?php

namespace App\Http\Modules\CategoriasAdjuntos\Controller;

use App\Http\Controllers\Controller;
use App\Http\Modules\CategoriasAdjuntos\Service\CategoriaAdjuntoService;
use Illuminate\Http\Request;

class CategoriasAdjuntosController extends Controller
{
    public function __construct(
        protected CategoriaAdjuntoService $categoriaAdjuntoService,
    ) {}

    public function crear(Request $request)
    {
        try {
            $categorias = $this->categoriaAdjuntoService->crear($request->all());
            return response()->json($categorias);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function listar()
    {
        try {
            $categorias = $this->categoriaAdjuntoService->listar();
            return response()->json($categorias);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function actualizar($id, Request $request)
    {
        try {
            $categorias = $this->categoriaAdjuntoService->actualizar($id, $request->all());
            return response()->json($categorias);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
