<?php

namespace App\Http\Modules\Oficios\Service;

use App\Http\Modules\Oficios\Models\Oficios;
use App\Services\BaseService;

class OficioService extends BaseService
{
    public function __construct(protected Oficios $oficios)
    {
        parent::__construct($this->oficios);
    }
}
