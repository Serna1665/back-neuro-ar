<?php

namespace App\Http\Modules\Permisos\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Permisos\Requests\AsignarPermisoRoleRequest;
use App\Http\Modules\Permisos\Requests\AsignarPermisoUserRequest;
use App\Http\Modules\Permisos\Requests\CrearPermisosRequest;
use App\Http\Modules\Permisos\Services\PermisosServices;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    public function __construct(
        protected PermisosServices $permisosServices,
    ) {}

    public function crearPermisos(CrearPermisosRequest $request)
    {
        try {
            $permiso = $this->permisosServices->crearPermiso($request->validated());
            return response()->json($permiso, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function AsignarPermisoRole(AsignarPermisoRoleRequest $request)
    {
        try {
            $permiso = $this->permisosServices->AsignarPermisoArole($request->validated());
            return response()->json($permiso, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function asignarPermisoAusuario(AsignarPermisoUserRequest $request)
    {
        try {
            $user = $this->permisosServices->asignarPermisoAusuario($request->validated());
            return response()->json($user, 201);
         } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function listarPermisos()
    {
        try {
            $permisos = $this->permisosServices->listar();
            return response()->json($permisos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function listarPermisosDeUsuario($user_id)
    {
        try {
            $permisos = $this->permisosServices->listarPermisosDeUsuario($user_id);
            return response()->json($permisos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function actualizarPermisos($id, Request $request)
    {
        try {
            $permisos = $this->permisosServices->actualizarPermiso($id, $request->all());
            return response()->json($permisos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function listarPermisosRol($id)
    {
        try {
            $permisos = $this->permisosServices->listarPermisosDeRole($id);
            return response()->json($permisos);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
