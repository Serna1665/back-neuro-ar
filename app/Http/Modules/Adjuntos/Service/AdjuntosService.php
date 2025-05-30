<?php

namespace App\Http\Modules\Adjuntos\Service;

use App\Http\Modules\Adjuntos\Model\Adjuntos;
use App\Http\Modules\Pacientes\Models\Pacientes;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        // Nombre de la carpeta donde se guardarán los archivos
        $carpetaFTP = 'neuroArAdjuntos';

        // Verificar si la carpeta existe, y si no, crearla
        if (!Storage::disk('ftp_hostinger')->exists($carpetaFTP)) {
            Storage::disk('ftp_hostinger')->makeDirectory($carpetaFTP);
            Log::info("Carpeta creada en FTP: $carpetaFTP");
        }

        foreach ($archivos as $archivo) {
            Log::info('Procesando archivo:', ['nombre' => $archivo->getClientOriginalName()]);

            if (!$archivo->isValid()) {
                continue;
            }

            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $rutaFTP = $carpetaFTP . '/' . $nombreArchivo;

            Log::info('Ruta real del archivo:', ['path' => $archivo->getRealPath()]);
            Log::info('Ruta FTP:', ['ruta' => $rutaFTP]);

            try {
                $subido = Storage::disk('ftp_hostinger')->put($rutaFTP, fopen($archivo->getRealPath(), 'r'));
                Log::info('Archivo subido al FTP:', ['resultado' => $subido]);
            } catch (\Exception $e) {
                Log::error('Excepción al subir al FTP:', ['error' => $e->getMessage()]);
                $subido = false;
            }

            if ($subido) {
                $guardados[] = $this->adjuntos->create([
                    'nombre' => $archivo->getClientOriginalName(),
                    'ruta' => $rutaFTP,
                    'user_registra_id' => Auth::id(),
                    'paciente_id' => $data->paciente_id,
                    'tipo_adjuntos_id' => $data->tipo_adjuntos_id,
                ]);
            } else {
                Log::error("Error al subir archivo a FTP: {$nombreArchivo}", [
                    'archivo_valido' => $archivo->isValid(),
                    'ruta' => $rutaFTP,
                    'real_path' => $archivo->getRealPath(),
                ]);
            }
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
