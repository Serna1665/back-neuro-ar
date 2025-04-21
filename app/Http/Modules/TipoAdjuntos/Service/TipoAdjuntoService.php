<?php

namespace App\Http\Modules\TipoAdjuntos\Service;

use App\Http\Modules\TipoAdjuntos\Model\TipoAdjuntos;
use App\Services\BaseService;

class TipoAdjuntoService extends BaseService
{
    public function __construct(protected TipoAdjuntos $tipoAdjuntos)
    {
        parent::__construct($this->tipoAdjuntos);
    }

    public function listar()
    {
        return $this->tipoAdjuntos->with('categoriaAdjunto')->get();
    }

    public function listarPorCategoria(int $categoria_id)
    {
        return $this->tipoAdjuntos->where('categoria_adjunto_id', $categoria_id)->get();
    }
}
