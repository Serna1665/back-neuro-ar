<?php

namespace App\Http\Modules\Estados\Service;

use App\Http\Modules\Estados\Models\Estados;
use App\Services\BaseService;

class EstadoService extends BaseService
{
    public function __construct(protected Estados $estados)
    {
        parent::__construct($this->estados);
    }
}
