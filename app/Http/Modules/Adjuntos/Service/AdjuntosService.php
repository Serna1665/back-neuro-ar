<?php

namespace App\Http\Modules\Adjuntos\Service;

use App\Http\Modules\Adjuntos\Model\Adjuntos;
use App\Http\Modules\Pacientes\Models\Pacientes;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdjuntosService extends BaseService
{
    public function __construct(protected Adjuntos $adjuntos)
    {
        parent::__construct($this->adjuntos);
    }

    public function crear($data)
    {
        if (!$data->hasFile('file')) {
            throw new \Exception('No se enviaron archivos.');
        }

        $archivos = $data->file('file');
        $archivos = is_array($archivos) ? $archivos : [$archivos];
        $guardados = [];

        foreach ($archivos as $archivo) {
            Log::info('Procesando archivo:', ['nombre' => $archivo->getClientOriginalName()]);
            if (!$archivo->isValid()) {
                continue;
            }

            $fileName = time() . '_' . $archivo->getClientOriginalName();
            $path = $archivo->storeAs('adjuntos', $fileName, 'public');

            $guardados[] = $this->adjuntos->create([
                'nombre' => $archivo->getClientOriginalName(),
                'ruta' => $path,
                'user_registra_id' => Auth::id(),
                'paciente_id' => $data->paciente_id,
                'tipo_adjuntos_id' => $data->tipo_adjuntos_id,
            ]);
        }

        return $guardados;
    }

    public function obtenerAdjuntosPorPaciente($pacienteId)
    {
        // Obtener los adjuntos relacionados con el paciente
        $adjuntos = $this->adjuntos::where('paciente_id', $pacienteId)->with(['usuarioRegistra', 'paciente', 'tipoAdjunto'])->get();

        // Retornar los adjuntos encontrados
        return $adjuntos;
    }
}
