<?php

namespace App\Http\Modules\CategoriasAdjuntos\Service;

use App\Http\Modules\CategoriasAdjuntos\Model\CategoriasAdjuntos;
use App\Services\BaseService;

class CategoriaAdjuntoService extends BaseService
{
    public function __construct(protected CategoriasAdjuntos $categorias)
    {
        parent::__construct($this->categorias);
    }
}
