<?php

namespace App\Http\Modules\Departamentos\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $fillable = ['nombre', 'codigo_dane'];
}
