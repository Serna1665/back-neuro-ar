<?php

namespace App\Http\Modules\Empresas\Models;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = ['nombre', 'nit', 'direccion', 'telefono', 'email'];
}
