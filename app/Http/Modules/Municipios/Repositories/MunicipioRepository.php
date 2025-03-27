<?php

namespace App\Http\Modules\Municipios\Repositories;

use App\Http\Modules\Municipios\Models\Municipios;

class MunicipioRepository
{
    /**
     * Obtiene todos los registros de municipios.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Municipios::all();
    }

    /**
     * Obtiene los municipios filtrados por departamento.
     *
     * @param string|int $departamentoCodigo
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByDepartamento($departamentoCodigo)
    {
        return Municipios::where('departamento_id', $departamentoCodigo)->get();
    }
}
