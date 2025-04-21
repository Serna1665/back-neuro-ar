<?php

namespace App\Http\Modules\TipoAdjuntos\Model;

use App\Http\Modules\CategoriasAdjuntos\Model\CategoriasAdjuntos;
use Illuminate\Database\Eloquent\Model;

class TipoAdjuntos extends Model
{
    protected $fillable = [
        'nombre',
        'categoria_adjunto_id',
    ];

    public function categoriaAdjunto()
    {
        return $this->belongsTo(CategoriasAdjuntos::class, 'categoria_adjunto_id');
    }
}
