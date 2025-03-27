<?php

namespace App\Http\Modules\Pacientes\Models;

use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    protected $fillable = [
        'user_id',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'oficio_id',
        'genero',
        'lateralidad_dominante',
        'municipio_id',
        'tipo_documento_id',
        'empresa_id',
        'estatura',
        'estado_id',
        'usa_lentes'
    ];
}
