<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\EmailController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController
{
    // METODO PARA REGISTRAR NUEVO USUARIO
    public function registrar(Request $request)
    {
        $request->validate([
            'UserName' => 'required|string|min:5',
            'UserEmail' => 'required|string|unique:users,email|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/',
            'UserPassword' => 'required|string|min:8',
            'UserConfirmPassword' => 'required|string|min:8',
        ]);    

        if ($request->post('UserPassword') !== $request->post('UserConfirmPassword')) {
            return redirect()->back()->withErrors('Las contraseñas no coinciden');
        }
        // CREAMOS EL TOKEN DE VERIFICACION
        $token = Str::random(50);
        // GENERAMOS EL INSERT EN AL TABLA "users"
        User::insert([
            'fk_rol' => 3,
            'user_name' => $request->post('UserName'),
            'email' => $request->post('UserEmail'),
            'password' => Hash::make($request->post('UserPassword')),
            'email_verified' => 'false',
            'user_token' => $token,
            'user_status' => 'sin verificar',
        ]);

        // ENVIAMOS EL TOKEN DE CONFIRMACION POR CORREO
        $EmailController = new EmailController;
        $EmailController->emailConfirm($token, $request->post('UserEmail'));

        return redirect()->route('login')->with('success','Verifique su correo para iniciar sesión');
    }

    // METODO PARA VERIFICAR EL TOKEN DE AUTENTICACION
    public function verificar($token)
    {
        // HAYAR AL USUARIO POR EL TOKEN UNICO
        User::where('user_token', $token)
        ->update([
            'email_verified' => 'true',
            'user_status' => 'activo',
        ]);

        $verifiedEmailSuccess = 'Correo verificado, inicie sesión';
        return redirect()->route('login', ['verifiedEmailSuccess'=> $verifiedEmailSuccess]);
    }
}
