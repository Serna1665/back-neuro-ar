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

        if (!Storage::disk('public')->exists($rutaArchivo)) {
            throw new \Exception('La ruta del archivo no existe en el almacenamiento');
        }

        return Storage::disk('public')->download($rutaArchivo);
    }
}
