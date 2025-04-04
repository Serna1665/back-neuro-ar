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

    public function __construct(EmpresaRepository $empresaRepository, EmpresaService $empresaService)
    {
        $this->empresaRepository = $empresaRepository;
        $this->empresaService = $empresaService;
    }

    /**
     * Lista todas las empresas activas.
     */
    public function listarActivas()
    {
        $empresas = $this->empresaRepository->listarActivas();
        return response()->json($empresas);
    }

    public function listarTodas()
    {
        $empresas = $this->empresaRepository->listarTodas();
        return response()->json($empresas);
    }

    /**
     * Crea una nueva empresa.
     */
    public function crearEmpresas(EmpresaRequest $request)
    {
        try {
            $empresa = $this->empresaService->crear($request->validated());
            return response()->json($empresa, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Actualiza una empresa existente.
     */
    public function actualizarEmpresa($id, Request $request)
    {
        try {
            $actualizar = $this->empresaService->actualizar($id, $request->all());
            return response()->json($actualizar);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Cambia el estado de la empresa a inactivo en lugar de eliminarla.
     */
    public function cambiarEstadoEmpresa($id)
    {
        return $this->empresaService->toggleEstado($id);
    }
}
