<?php

namespace App\Http\Modules\Pacientes\Repositories;

use App\Http\Modules\Pacientes\Models\Pacientes;
use App\Models\User;

class pacienteRepository
{

    /**
     * consultarUsuario
     * Buscar usuario por numero de documento, nombre y correo electronico
     *
     * @param  mixed $data
     * @return void
     */
    public function consultarUsuario($data)
    {
        return User::where(function ($query) use ($data) {
            if (!empty($data['nombre'])) {
                $query->orWhere('name', 'like', '%' . $data['nombre'] . '%');
            }
            if (!empty($data['email'])) {
                $query->orWhere('email', 'like', '%' . $data['email'] . '%');
            }
            if (!empty($data['documento'])) {
                $query->orWhere('numero_documento', 'like', '%' . $data['documento'] . '%');
            }
        })->get();
    }

    /**
     * datosPaciente
     * Obtener los datos del paciete por medio del user_id
     *
     * @param  mixed $user_id
     * @return void
     */
    public function datosPaciente($user_id)
    {
        return Pacientes::where('user_id', $user_id)->with(['municipio'])->first();
    }

    public function listarPacientesPorEmpresa($user_id)
    {
        $paciente = Pacientes::where('user_id', $user_id)->first();

        if (!$paciente || !$paciente->empresa_id) {
            return [];
        }

        return Pacientes::select('id', 'nombres', 'apellidos')
            ->where('empresa_id', $paciente->empresa_id)
            ->get();
    }

    public function obtenerPacientesPorEmpresaDeUsuario($user_id)
    {
        $paciente = Pacientes::where('user_id', $user_id)->first();

        if (!$paciente || !$paciente->empresa_id) {
            throw new \Exception('Paciente o empresa no encontrada');
        }

        return Pacientes::select('id', 'nombres', 'apellidos')
            ->where('empresa_id', $paciente->empresa_id)
            ->get();
    }
}
