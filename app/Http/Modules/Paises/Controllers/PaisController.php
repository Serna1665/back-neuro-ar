<?php

namespace App\Http\Modules\Paises\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\paises\Repositories\PaisRepository;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    protected $paisRepository;

    /**
     * Inyección de dependencias del repositorio.
     *
     * @param PaisRepository $paisRepository
     */
    public function __construct(PaisRepository $paisRepository)
    {
        $this->paisRepository = $paisRepository;
    }

    /**
     * Lista todos los registros de paises.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paises = $this->paisRepository->getAll();

        return response()->json($paises);
    }
}
