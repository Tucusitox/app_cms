<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmailController
{   
    // ENIVAR CORREO DE CONFIRMACION AL USUARIO CON UN TOKEN
    public function emailConfirm($id_user, $destinatario)
    {
        $token = Str::random(50);
        $mensaje = "Estimado usuario confirme su correo con un clik en el botón:";

        User::where('user_id', $id_user)
        ->update(['user_token' => $token]);

        // LAMAMOS A LA CLASE CONSTRUCTORA PARA ENVIAR EL CORREO
        dispatch(new SendEmailJob([
            'token' => $token,
            'mensaje' => $mensaje,
            'destinatario' => $destinatario,
        ]));
    }

    // ENIVAR CORREO DE CONFIRMACION AL USUARIO CON UN CODIGO ALEATORIO
    public function recoverPassword($id_user, $destinatario)
    {
        // GENERAR EL CODIGO ALEATORIO
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $longitud = 8;
        $codigo = '';
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        User::where('user_id', $id_user)
        ->update(['password' => Hash::make($codigo)]);

        // ENVIAR CORREO AL USUARIO MEDIANTE UN JOB EN SEGUNDO PLANO
        $asunto = "Codigo de recuperación";
        $mensaje = "Estimado usuario recupere su contraseña con el siguiente código:";

        // LAMAMOS A LA CLASE CONSTRUCTORA PARA ENVIAR EL CORREO
        dispatch(new SendEmailJob([
            'asunto' => $asunto,
            'codigo' => $codigo,
            'mensaje' => $mensaje,
            'destinatario' => $destinatario,
        ]));
    }

    // METODO PARA EL FORMULARIO DE CONTACTANOS
    public function contactForm($nombre, $correoContact, $mensaje)
    {
        $asunto = "Página de contacto";
        $destinatario = "kuramasenin555@gmail.com";

        // LAMAMOS A LA CLASE CONSTRUCTORA PARA ENVIAR EL CORREO
        dispatch(new SendEmailJob([
            'asunto' => $asunto,
            'nombre' => $nombre,
            'correoContact' => $correoContact,
            'mensaje' => $mensaje,
            'destinatario' => $destinatario,
        ]));
    }
}
