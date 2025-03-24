<?php

namespace App\Http\Modules\Oficios\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficios extends Model
{
    use SoftDeletes;
    protected $fillable = ['nombre'];
}
