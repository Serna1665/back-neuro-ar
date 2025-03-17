<?php

namespace App\Http\Modules\Pacientes\Services;

use App\Http\Modules\Pacientes\Models\Pacientes;

class PacientesService
{
    public function crearPaciente($data)
    {
        return Pacientes::create($data);
    }
}
