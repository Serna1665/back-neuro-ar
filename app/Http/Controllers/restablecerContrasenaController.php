<?php

namespace App\Http\Controllers;

use App\Mail\RecuperarContrasenaMail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class restablecerContrasenaController extends Controller
{
    public function enviarCorreo(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $usuarios = User::where('email', $request->email)->get();

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        // Enviar correo
        Mail::to($request->email)->send(new RecuperarContrasenaMail($usuarios, $token));

        return response()->json(['message' => 'Se ha enviado un correo para recuperar la contraseña.']);
    }

    public function validarToken(Request $request)
    {
        Log::info('Token recibido: ' . $request->token);

        $request->validate([
            'token' => 'required',
        ]);

        $registro = DB::table('password_reset_tokens')->where('created_at', '>=', Carbon::now()->subMinutes(60))->get();

        foreach ($registro as $row) {
            if (Hash::check($request->token, $row->token)) {
                return response()->json(['email' => $row->email], 200);
            }
        }

        return response()->json(['message' => 'Token inválido o expirado'], 400);
    }

    public function actualizarContrasena(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $registro = DB::table('password_reset_tokens')->where('created_at', '>=', Carbon::now()->subMinutes(60))->get();

        foreach ($registro as $row) {
            if (Hash::check($request->token, $row->token)) {
                User::where('email', $row->email)->update([
                    'password' => Hash::make($request->password)
                ]);

                DB::table('password_reset_tokens')->where('email', $row->email)->delete();

                return response()->json(['message' => 'Contraseña actualizada correctamente.']);
            }
        }

        return response()->json(['message' => 'Token inválido o expirado'], 400);
    }
}
