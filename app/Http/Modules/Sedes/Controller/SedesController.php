<?php

namespace App\Http\Modules\Sedes\Controller;

use App\Http\Controllers\Controller;
use App\Http\Modules\Sedes\Requests\CrearSedesRequest;
use App\Http\Modules\Sedes\Service\SedesService;
use Illuminate\Http\Request;

class SedesController extends Controller
{
    public function __construct(
        protected SedesService $sedesService,
    ) {}

    public function crearSedes(CrearSedesRequest $request)
    {
        try {
            $sedes = $this->sedesService->crear($request->validated());
            return response()->json($sedes);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function listarSedes()
    {
        try {
            $sedes = $this->sedesService->listarSedes();
            return response()->json($sedes);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function actualizar($id, Request $request)
    {
        try {
            $sedes = $this->sedesService->actualizar($id, $request->all());
            return response()->json($sedes);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
