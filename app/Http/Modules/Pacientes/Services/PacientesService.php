<?php

namespace App\Http\Modules\Pacientes\Services;

use App\Http\Modules\Pacientes\Models\Pacientes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PacientesService
{


    public function registrarUsuarioYPaciente($request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => "{$request['nombres']} {$request['apellidos']}",
                'email' => $request['email'],
                'password' => Hash::make($request['numero_documento']),
                'numero_documento' => $request['numero_documento'],
                'estado_id' => 1
            ]);

            // Crear paciente con el user_id recién creado
            $pacienteData = [
                'user_id' => $user->id,
                'nombres' => $request['nombres'],
                'apellidos' => $request['apellidos'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
                'oficio_id' => $request['oficio_id'],
                'genero' => $request['genero'],
                'lateralidad_dominante' => $request['lateralidad_dominante'],
                'municipio_id' => $request['municipio_id'],
                'tipo_documento_id' => $request['tipo_documento_id'],
                'empresa_id' => $request['empresa_id'],
                'estatura' => $request['estatura'],
                'estado_id' => 1,
                'usa_lentes' => $request['usa_lentes'],
                'sede_id' => $request['sede_id'],
                'dependencia_id' => $request['dependencia_id'],
            ];

            $paciente = Pacientes::create($pacienteData);

            DB::commit();

            return [
                'usuario' => $user,
                'paciente' => $paciente
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function actualizarPaciente(array $data)
    {
        DB::beginTransaction();

        try {
            $paciente = Pacientes::where('user_id', $data['user_id'])->first();
            $paciente->update($data);
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            // Actualizar el usuario
            User::findOrFail($data['user_id'])->update($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
