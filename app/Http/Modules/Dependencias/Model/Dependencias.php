<?php

namespace App\Http\Modules\Dependencias\Model;

use App\Http\Modules\Estados\Models\Estados;
use Illuminate\Database\Eloquent\Model;

class Dependencias extends Model
{
    protected $fillable = [
        'nombre',
        'estado_id'
    ];

    public function estado()
    {
        return $this->belongsTo(Estados::class, 'estado_id');
    }
}
