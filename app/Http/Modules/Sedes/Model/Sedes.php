<?php

namespace App\Http\Modules\Sedes\Model;

use App\Http\Modules\Empresas\Models\Empresas;
use App\Http\Modules\Estados\Models\Estados;
use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'estado_id',
        'empresa_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresas::class, 'empresa_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estados::class, 'estado_id');
    }

}
