<?php

namespace App\Http\Modules\Municipios\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Municipios\Repositories\MunicipioRepository;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    protected $municipioRepository;

    /**
     * Inyección de dependencias del repositorio.
     *
     * @param MinicipioRepository $municipioRepository
     */
    public function __construct(MunicipioRepository $municipioRepository)
    {
        $this->municipioRepository = $municipioRepository;
    }

    /**
     * Lista todos los registros de municipios.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($departamento = null)
    {
        if ($departamento) {
            $municipios = $this->municipioRepository->getByDepartamento($departamento);
        } else {
            $municipios = $this->municipioRepository->getAll();
        }

        return response()->json($municipios);
    }
}
