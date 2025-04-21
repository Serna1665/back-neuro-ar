<?php

namespace App\Http\Modules\Adjuntos\Model;

use App\Http\Modules\Pacientes\Models\Pacientes;
use App\Http\Modules\TipoAdjuntos\Model\TipoAdjuntos;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Adjuntos extends Model
{
    protected $fillable = [
        'nombre',
        'ruta',
        'user_registra_id',
        'paciente_id',
        'tipo_adjuntos_id'
    ];

    public function usuarioRegistra()
    {
        return $this->belongsTo(User::class, 'user_registra_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Pacientes::class, 'paciente_id');
    }

    public function tipoAdjunto()
    {
        return $this->belongsTo(TipoAdjuntos::class, 'tipo_adjuntos_id');
    }



}
