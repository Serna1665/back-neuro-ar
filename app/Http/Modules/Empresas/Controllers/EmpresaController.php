<?php

namespace App\Http\Modules\Empresas\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Empresas\Repositories\EmpresaRepository;
use App\Http\Modules\Empresas\Requests\EmpresaRequest;
use App\Http\Modules\Empresas\Service\EmpresaService;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    protected $empresaRepository;
    protected $empresaService;

    /**
     * Inyección de dependencias del repositorio.
     *
     * @param empresaRepository $empresaRepository
     */
    public function __construct(EmpresaRepository $empresaRepository, EmpresaService $empresaService)
    {
        $this->empresaRepository = $empresaRepository;
        $this->empresaService = $empresaService;
    }

    /**
     * Lista todos los registros de empresas.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $empresas = $this->empresaRepository->getAll();

        return response()->json($empresas);
    }

    /**
     * Crear empresas
     *
     * @param  mixed $request
     * @return void
     * @author Serna
     */
    public function crearEmpresas(EmpresaRequest $request)
    {
        try {
            $empresas = $this->empresaService->crear($request->validated());
            return response()->json($empresas, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function actualizarEmpresa($id, Request $request)
    {
        try {
            $actualizar = $this->empresaService->actualizar($id, $request->all());
            return response()->json($actualizar);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function buscarEmpresas(Request $request)
    {
        try {
            $empresas = $this->empresaRepository->buscarEmpresas($request);
            return response()->json($empresas);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
