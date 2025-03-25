<?php

namespace App\Http\Modules\paises\Repositories;

use App\Http\Modules\Paises\Models\Pais;

class PaisRepository
{
    /**
     * Obtiene todos los registros de municipios.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Pais::all();
    }
}
