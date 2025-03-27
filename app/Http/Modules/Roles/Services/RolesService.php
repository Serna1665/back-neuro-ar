<?php

namespace App\Http\Modules\Roles\Services;

use App\Models\User;
use App\Services\BaseService;
use Spatie\Permission\Models\Role;

class RolesService extends BaseService
{

    public function __construct(protected Role $role)
    {
        parent::__construct($this->role);
    }
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
        $user->syncRoles([$data['role_id']]);
        return $user;
    }

    /**
     * Función para listar los roles asignados a un usuario por su ID.
     *
     * @param  int $userId
     * @return array
     * @author Serna
     */
    public function ListarRolesUsuario(int $userId)
    {
        $roles = User::findOrFail($userId)
            ->roles()
            ->select('id', 'name')
            ->get();

        return $roles;
    }

    public function actualizarRole(int $id, array $data) {
        return Role::findOrFail($id)->update($data);
    }
}
