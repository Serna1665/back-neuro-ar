<?php

namespace App\Http\Modules\Paises\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $fillable = [
        'nombre',
        'codigo_dane',
    ];
}
