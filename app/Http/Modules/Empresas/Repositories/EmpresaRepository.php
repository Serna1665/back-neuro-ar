<?php

namespace App\Http\Modules\Empresas\Repositories;

use App\Http\Modules\Empresas\Models\Empresas;

class EmpresaRepository
{
    /**
     * Obtiene todas las empresas activas (estado_id = 1).
     */
    public function listarTodas()
    {
        return Empresas::all();
    }

    public function listarActivas()
    {
        return Empresas::where('estado_id', 1)->get();
    }


    /**
     * Obtiene una empresa por ID.
     */
    public function findById($id)
    {
        return Empresas::findOrFail($id);
    }
}
