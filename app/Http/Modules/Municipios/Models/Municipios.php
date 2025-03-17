<?php

namespace App\Http\Modules\Municipios\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $fillable = ['departamento_id', 'nombre', 'codigo_dane'];
}
