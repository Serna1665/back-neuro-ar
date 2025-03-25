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
}
