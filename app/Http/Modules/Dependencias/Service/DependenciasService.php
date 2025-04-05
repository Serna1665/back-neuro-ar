<?php

namespace App\Http\Modules\Dependencias\Service;

use App\Http\Modules\Dependencias\Model\Dependencias;
use App\Services\BaseService;

class DependenciasService extends BaseService
{
    public function __construct(protected Dependencias $dependencias)
    {
        parent::__construct($this->dependencias);
    }

    public function listarDependenciasActivas(){
        return $this->dependencias->where('estado_id', 1)->get();
    }
}
