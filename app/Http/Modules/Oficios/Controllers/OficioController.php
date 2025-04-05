<?php

namespace App\Http\Modules\Oficios\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Modules\Oficios\Models\Oficios;
use App\Http\Modules\Oficios\Service\OficioService;
use App\Http\Modules\Oficios\Request\CrearOficioRequest;
use App\Http\Modules\Oficios\Repositories\OficioRepository;

class OficioController extends Controller
{
    protected $oficioRepository;
    protected $oficioService;

    /**
     * Inyección de dependencias del repositorio.
     *
     * @param OficioRepository $oficioRepository
     */
    public function __construct(OficioRepository $oficioRepository, OficioService $oficioService)
    {
        $this->oficioRepository = $oficioRepository;
        $this->oficioService = $oficioService;
    }

    /**
     * Lista todos los registros de oficios.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $oficios = $this->oficioRepository->getAll();

        return response()->json($oficios);
    }

    /**
     * Crear oficios
     *
     * @param  mixed $request
     * @return void
     * @author Serna
     */
    public function crearOficios(CrearOficioRequest $request)
    {
        try {
            $oficios = $this->oficioService->crear($request->validated());
            return response()->json($oficios, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * actualizarOficio
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     * @author Serna
     */
    public function actualizarOficio($id, Request $request)
    {
        try {
            $actualizar = $this->oficioService->actualizar($id, $request->all());
            return response()->json($actualizar);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * eliminarOficio
     *
     * @param  mixed $id
     * @return void
     * @author Serna
     */
    public function eliminarOficio($id)
    {
        try {
            $eliminar = $this->oficioService->eliminar($id);
            return response()->json($eliminar);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
    public function buscar(Request $request)
    {
        try {
            $query = $request->input('q');

            if (!$query || strlen($query) < 4) {
                return response()->json([]);
            }

            return response()->json(
                Oficios::where('nombre', 'like', "%{$query}%")
                    ->limit(20)
                    ->get()
            );
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error al buscar oficios'], 500);
        }
    }
}
