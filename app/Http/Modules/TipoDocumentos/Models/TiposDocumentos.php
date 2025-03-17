<?php

namespace App\Http\Modules\TipoDocumentos\Models;

use Illuminate\Database\Eloquent\Model;

class TiposDocumentos extends Model
{
    protected $fillable = ['nombre', 'sigla'];
}
