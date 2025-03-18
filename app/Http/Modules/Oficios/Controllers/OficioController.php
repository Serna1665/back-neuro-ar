<?php

namespace App\Http\Modules\Oficios\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Oficios\Repositories\OficioRepository;

class OficioController extends Controller
{
    protected $oficioRepository;

    /**
     * Inyección de dependencias del repositorio.
     *
     * @param OficioRepository $oficioRepository
     */
    public function __construct(OficioRepository $oficioRepository)
    {
        $this->oficioRepository = $oficioRepository;
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
}
