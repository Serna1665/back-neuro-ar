<?php

namespace App\Http\Modules\Departamentos\Repositories;

use App\Http\Modules\Departamentos\Models\Departamentos;

class DepartamentoRepository
{
    /**
     * Obtiene todos los registros de departamentos.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Departamentos::all();
    }
}
