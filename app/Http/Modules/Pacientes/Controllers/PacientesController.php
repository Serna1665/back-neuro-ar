<?php

namespace App\Http\Modules\Pacientes\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Pacientes\Repositories\pacienteRepository;
use App\Http\Modules\Pacientes\Requests\CrearPacienteRequest;
use App\Http\Modules\Pacientes\Services\PacientesService;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class PacientesController extends Controller
{
    public function __construct(
        protected PacientesService $pacientesService,
        protected pacienteRepository $pacienteRepository
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

    public function buscarUsuario(Request $request)
    {
        try {
            $usuario = $this->pacienteRepository->consultarUsuario($request->all());
            return response()->json($usuario);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function datosPaciente($user_id)
    {
        try {
            $paciente = $this->pacienteRepository->datosPaciente($user_id);
            return response()->json($paciente);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function actualizarDatos(Request $request)
    {
        try {
            $actualizar = $this->pacientesService->actualizarPaciente($request->all());
            return response()->json($actualizar);
        } catch (\Throwable $th) {
            return response()->json(['erorr' => $th->getMessage()], 400);
        }
    }

    public function obtenerPacienteIdPorUserId($userId)
    {
        $paciente = $this->pacienteRepository->obtenerPacienteIdPorUserId($userId);

        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        return response()->json(['paciente_id' => $paciente->id]);
    }
}
