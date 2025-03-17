<?php

namespace App\Http\Modules\Pacientes\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Pacientes\Requests\CrearPacienteRequest;
use App\Http\Modules\Pacientes\Services\PacientesService;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function __construct(
        protected PacientesService $pacientesService,
    ) {}

    public function CrearPacientes(CrearPacienteRequest $request)
    {
        try {
            $paciente = $this->pacientesService->registrarUsuarioYPaciente($request->validated());
            return response()->json($paciente, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
