<?php

namespace App\Http\Modules\Oficios\Repositories;

use App\Http\Modules\Oficios\Models\Oficios;

class OficioRepository
{
    /**
     * Obtiene todos los registros de oficios.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Oficios::all();
    }
}
