<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registrar usuario nuevo
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['usuario' => $user], 201);
    }

    /**
     * Funcion para que un usuario creado se pueda loguear en la aplicacion
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $users = User::where('email', $request->email)->get();

        if ($users->isEmpty()) {
            return response()->json(['error' => 'No se encontró ninguna cuenta con este correo.'], 401);
        }

        if ($users->count() > 1) {
            $request->validate([
                'numero_documento' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)
                ->where('numero_documento', $request->numero_documento)
                ->first();

            if (!$user) {
                return response()->json(['error' => 'Número de documento no encontrado.'], 404);
            }
        } else {
            $request->validate([
                'password' => 'required',
            ]);

            $user = $users->first();
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Las credenciales son incorrectas.'], 401);
        }

        // Generamos el token de autenticación
        $token = $user->createToken('auth_token')->plainTextToken;

        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions()->pluck('name');

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'documento' => $user->documento,
                'created_at' => $user->created_at,
                'roles' => $roles,
                'permissions' => $permissions,
                'paciente' => $user->paciente
            ]
        ]);
    }


    /**
     * Funcion para cerrar sesion
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }

    /**
     * Funcion para validar cuantos usuarios tiene el numero de documento ingresado
     *
     * @param  mixed $request
     * @return void
     */
    public function validarEmail(Request $request)
    {
        try {
            $emails = User::where('email', $request[0])->get();
            return response()->json($emails);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    public function me(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $roles = $user->getRoleNames();
        $permissions = $user->getAllPermissions()->pluck('name');

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'documento' => $user->documento,
                'created_at' => $user->created_at,
                'roles' => $roles,
                'permissions' => $permissions,
                'paciente' => $user->paciente
            ]
        ]);
    }
}
