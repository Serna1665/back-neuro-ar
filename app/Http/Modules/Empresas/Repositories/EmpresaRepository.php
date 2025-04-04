<?php

namespace App\Http\Modules\Empresas\Repositories;

use App\Http\Modules\Empresas\Models\Empresas;

class EmpresaRepository
{
    /**
     * Obtiene todos los registros de empresas.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Empresas::all();
    }


    /**
     * Busca empresas por nombre con un LIKE.
     *
     * @param string $nombre El nombre o parte del nombre a buscar.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function buscarEmpresas($nombre)
    {
        return Empresas::where('nombre', 'LIKE', '%' . $nombre . '%')->get();
    }
}
