<?php

namespace App\Http\Modules\Departamentos\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Departamentos\Repositories\DepartamentoRepository;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    protected $departamentoRepository;

    /**
     * Inyección de dependencias del repositorio.
     *
     * @param MunicipioRepository $departamentoRepository
     */
    public function __construct(DepartamentoRepository $departamentoRepository)
    {
        $this->departamentoRepository = $departamentoRepository;
    }

    /**
     * Lista todos los registros de departamentos.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $departamentos = $this->departamentoRepository->getAll();

        return response()->json($departamentos);
    }
}
