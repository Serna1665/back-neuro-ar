<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BaseService
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Funcion base para crear, recibe como parametros los datos para crear
     *
     * @param  mixed $data
     * @return void
     */
    public function crear(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Funcion base para actualizar, recibe como parametros el id del registro y los datos a actualizar
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return void
     */
    public function actualizar(int $id, array $data)
    {
        $actualizar = $this->model->find($id);
        if ($actualizar) {
            $actualizar->update($data);
            return $actualizar;
        }
        return null;
    }

    /**
     * Funcion base para eliminar, recibe como parametros el id del registro
     *
     * @param  mixed $id
     * @return void
     */
    public function eliminar(int $id)
    {
        $eliminar = $this->model->find($id);
        return $eliminar ? $eliminar->delete() : false;
    }

    /**
     * Funcion base para buscar, recibe como parametro un id
     *
     * @param  mixed $id
     * @return void
     */
    public function buscar(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Funcion para listar todos los registros de un modelo
     *
     * @return void
     */
    public function listar()
    {
        return $this->model->all();
    }

    /**
     * Cambia el estado_id de un registro entre 1 y 2
     *
     * @param int $id
     * @return mixed
     */
    public function cambiarEstado(int $id)
    {
        $registro = $this->model->find($id);

        if ($registro) {
            $nuevoEstado = $registro->estado_id == 1 ? 2 : 1;
            $registro->update(['estado_id' => $nuevoEstado]);
            return $registro;
        }
        return null;
    }

    public function descargarArchivo(int $id, string $campoRuta = 'ruta')
    {
        $registro = $this->model->find($id);

        if (!$registro || !isset($registro->$campoRuta)) {
            throw new \Exception('Archivo no encontrado');
        }

        $rutaArchivo = $registro->$campoRuta;
        $nombreArchivo = $registro->nombre;

        if (!Storage::disk('ftp_hostinger')->exists($rutaArchivo)) {
            throw new \Exception('La ruta del archivo no existe en el almacenamiento');
        }

        $contenido = Storage::disk('ftp_hostinger')->get($rutaArchivo);

        // Obtener el mime type, si no se obtiene usar un valor por defecto
        $mimeType = Storage::disk('ftp_hostinger')->mimeType($rutaArchivo) ?? 'application/octet-stream';

        return response($contenido)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'attachment; filename="' . $nombreArchivo . '"');
    }

    public function eliminarAdjunto(int $id)
    {
        $registro = $this->model->find($id);

        if (!$registro) {
            throw new \Exception('Adjunto no encontrado en la base de datos.');
        }

        $rutaArchivo = $registro->ruta;

        // Verifica y elimina el archivo del FTP
        if (Storage::disk('ftp_hostinger')->exists($rutaArchivo)) {
            $eliminado = Storage::disk('ftp_hostinger')->delete($rutaArchivo);

            if (!$eliminado) {
                throw new \Exception('No se pudo eliminar el archivo del FTP.');
            }
        }

        // Elimina el registro de la base de datos
        $registro->delete();

        return response()->json(['mensaje' => 'Adjunto eliminado correctamente']);
    }
}
