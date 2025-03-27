<?php

namespace App\Http\Modules\Permisos\Services;

use App\Models\User;
use App\Services\BaseService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisosServices extends BaseService
{

    public function __construct(protected Permission $permission)
    {
        parent::__construct($this->permission);
    }
    /**
     * Funcion para crear un permiso recibiendo el nombre desde el request
     *
     * @param  mixed $data
     * @return void
     * @author Serna
     */
    public function crearPermiso(array $data)
    {
        $permiso = Permission::create(['name' => $data['name'], 'guard_name' => 'web']);
        return $permiso;
    }

    /**
     * Funcion para asignar un permiso a role
     *
     * @param  mixed $data
     * @return void
     * @author Serna
     */
    public function AsignarPermisoArole(array $data)
    {
        $role = Role::find($data['role_id']);
        $role->syncPermissions($data['permiso']);
        return $role;
    }

    /**
     * Funcion para asignar un permiso a un usuario directamente
     *
     * @param  mixed $data
     * @return void
     * @author Serna
     */
    public function asignarPermisoAusuario(array $data)
    {
        $user = User::findOrFail($data['user_id']);
        $user->syncPermissions($data['permiso']);
        return $user;
    }


    /**
     * Función para listar los permisos asignados a un usuario
     *
     * @param int $userId
     * @return \Illuminate\Support\Collection
     * @author Serna
     */
    public function listarPermisosDeUsuario(int $userId)
    {
        $user = User::findOrFail($userId);
        $permisos = $user->getAllPermissions();
        return $permisos;
    }

    public function actualizarPermiso(int $id, array $data) {
        return Permission::findOrFail($id)->update($data);
    }

      /**
     * Función para listar los permisos asignados a un rol
     *
     * @param int $roleId
     * @return \Illuminate\Support\Collection
     * @author Serna
     */
    public function listarPermisosDeRole(int $roleId)
    {
        $role = Role::findOrFail($roleId);
        $permisos = $role->permissions;
        return $permisos;
    }
}
