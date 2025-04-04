<?php

namespace App\Http\Modules\Empresas\Service;

use App\Http\Modules\Empresas\Models\Empresas;
use Illuminate\Support\Facades\DB;

class EmpresaService
{
    /**
     * Crea una nueva empresa con estado activo.
     */
    public function crear($data)
    {
        $data['estado_id'] = 1;
        return Empresas::create($data);
    }

    /**
     * Actualiza los datos de una empresa.
     */
    public function actualizar($id, $data)
    {
        $empresa = Empresas::findOrFail($id);
        $empresa->update($data);
        return $empresa;
    }

    /**
     * Cambia el estado de la empresa a inactivo en lugar de eliminarla.
     */
    public function toggleEstado($id)
{
    $empresa = Empresas::findOrFail($id);
    $empresa->estado_id = $empresa->estado_id === 1 ? 2 : 1;
    $empresa->save();
    return $empresa;
}

}
