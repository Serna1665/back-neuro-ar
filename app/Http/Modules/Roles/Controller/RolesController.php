<?php

namespace App\Http\Modules\Roles\Controller;

use App\Http\Controllers\Controller;
use App\Http\Modules\Roles\Requests\AsignarRolesRequest;
use App\Http\Modules\Roles\Requests\CrearRolesRequest;
use App\Http\Modules\Roles\Services\RolesService;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct(
        protected RolesService $rolesService,
    ) {}

    public function crearRoles(CrearRolesRequest $request)
    {
        try {
            $roles = $this->rolesService->CrearRoles($request->validated());
            return response()->json($roles, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function asignarRole(AsignarRolesRequest $request)
    {
        try {
            $roles = $this->rolesService->AsignarRole($request->validated());
            return response()->json($roles, 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }
}
