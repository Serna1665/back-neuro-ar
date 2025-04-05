<?php

namespace App\Http\Modules\Sedes\Service;

use App\Http\Modules\Sedes\Model\Sedes;
use App\Services\BaseService;

class SedesService extends BaseService
{
    public function __construct(protected Sedes $sedes)
    {
        parent::__construct($this->sedes);
    }

    public function listarSedes()
    {
        return $this->sedes->with(['empresa:id,nombre,nit', 'estado:id,nombre'])->get();
    }

    public function listarSedesPorEmpresa($empresa_id)
    {
        return $this->sedes->where('estado_id', 1)
            ->where('empresa_id', $empresa_id)
            ->get();
    }

    public function asignarDependencias(array $data)
    {
        $sede = $this->sedes::findOrFail($data['sede_id']);
        $sede->dependencias()->sync($data['dependencia_id']);
        return $sede;
    }

    public function obtenerSedeConDependencias(int $sede_id)
    {
        return $this->sedes->with('dependencias')->findOrFail($sede_id);
    }
}
