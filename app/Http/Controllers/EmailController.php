<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmailController
{   
    // ORDEN DEL LALMADO DE VARIABLES, COLOCAR COMO NULL LAS QUE NO SE NECESITEN
    // $asunto;
    // $codigo;
    // $token;
    // $nombre;
    // $correoContact;
    // $mensaje;
    // $destinatario;


    // ENIVAR CORREO DE CONFIRMACION AL USUARIO CON UN CODIGO ALEATORIO
    // public function emailConfirm($id_user, $destinatario)
    // {
    //     // GENERAR UPDATE EN LA TABLA CON EL CODIGO DE CONFIRMACION
    //     User::where('user_id', $id_user)->update(['email_verified' => Hash::make($codigo)]);
    //     // ENVIAR CORREO AL USUARIO MEDIANTE UN JOB EN SEGUNDO PLANO
    //     $mensaje = "Estimado usuario confirme su correo con el siguiente código:";
    //     dispatch(new SendEmailJob($codigo, null, null, null, $mensaje, $destinatario));
    // }

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
        User::where('user_id', $id_user)->update(['password' => Hash::make($codigo)]); //-> GENERAR UPDATE EN LA TABLA CON LA CONTRASEÑA
        // ENVIAR CORREO AL USUARIO MEDIANTE UN JOB EN SEGUNDO PLANO
        $asunto = "Codigo de recuperación";
        $mensaje = "Estimado usuario recupere su contraseña con el siguiente código:";
        dispatch(new SendEmailJob($asunto, $codigo, null, null, null, $mensaje, $destinatario));
    }

    // METODO PARA EL FORMULARIO DE CONTACTANOS
    public function contactForm($nombre, $correoContact, $mensaje)
    {
        $asunto = "Página de contacto";
        $destinatario = "kuramasenin555@gmail.com";
        dispatch(new SendEmailJob($asunto, null, null, $nombre, $correoContact, $mensaje, $destinatario));
    }
}
