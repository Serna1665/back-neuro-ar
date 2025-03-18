<?php

namespace App\Http\Modules\Roles\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesService
{
    /**
     * Funcion para crear roles
     *
     * @param  mixed $data
     * @return void
     * @author Serna
     */
    public function CrearRoles($data)
    {
        $role = Role::create(['name' => $data['name'], 'guard_name' => 'web']);
        return $role;
    }

    /**
     * Funcion para asignar un rol a un usuario recibiendo el id del usuario y el id del rol
     *
     * @param  mixed $data
     * @return void
     * @author Serna
     */
    public function AsignarRole($data)
    {
        $user = User::findOrFail($data['user_id']);
        $role = Role::findOrFail($data['role_id']);
        $user->assignRole($role->name);
        return $user;
    }
}
