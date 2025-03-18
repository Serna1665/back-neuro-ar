<?php

namespace App\Http\Modules\Permisos\Services;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisosServices
{
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
        $role = Role::findByName($data['role_id'], 'web');
        $role->givePermissionTo($data['permiso']);
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
        $user->givePermissionTo($data['permiso']);
        return $user;
    }

}
