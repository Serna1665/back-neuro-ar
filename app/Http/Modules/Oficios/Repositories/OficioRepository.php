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


    /**
     * Busca oficios por nombre con un LIKE.
     *
     * @param string $nombre El nombre o parte del nombre a buscar.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function buscarOficios($nombre)
    {
        return Oficios::where('nombre', 'LIKE', '%' . $nombre . '%')->get();
    }
}
