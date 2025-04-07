<?php

namespace App\Http\Modules\Pacientes\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Modules\Pacientes\Services\PacientesService;
use App\Http\Modules\Pacientes\Requests\CrearPacienteRequest;
use App\Http\Modules\Pacientes\Repositories\pacienteRepository;

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

    public function listarPacientesPorEmpresa($user_id)
    {
        try {
            $pacientes = $this->pacienteRepository->listarPacientesPorEmpresa($user_id);

            return response()->json($pacientes);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor'], 500);
        }
    }

    public function listarPorEmpresaDeUsuario($user_id): JsonResponse
    {
        try {
            $pacientes = $this->pacienteRepository->obtenerPacientesPorEmpresaDeUsuario($user_id);
            return response()->json($pacientes);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'No se pudo obtener los pacientes',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function actualizarDatosPersonales(Request $request)
    {
        try {
            $datos = $this->pacientesService->actualizarDatos($request->all());
            return response()->json($datos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
