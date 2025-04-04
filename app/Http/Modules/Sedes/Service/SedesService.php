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

}
