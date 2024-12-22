<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NewPasswordController
{
    // METODO PARA CAMBIAR CONTRASEÑA DE UN USUARIO CREADO POR UN ADMIN
    // PARA QUE PUEDA INICIAR SESION

    public function store(Request $request, $id_user)
    {
        $request->validate([
            'BeforePassword' => 'required|string|min:8',
            'NewPassword' => 'required|string|min:8',
            'ConfirmPassword' => 'required|string|min:8',
        ]);

        // CAPTURAMOS AL USUARIO
        $User = User::find($id_user);

        // CASO 1: LA CONTRASEÑA ANTERIOR ES INCORRECTA
        if (!Hash::check($request->post('BeforePassword') , $User->password)) {
            return redirect()->back()->withErrors('Contraseña anterior incorrecta');
        }
        // CASO 2: LAS CONTRASEÑAS NO COINCIDEN
        if ($request->post('NewPassword') !== $request->post('ConfirmPassword')) {
            return redirect()->back()->withErrors('Las contraseñas no coinciden');
        }
        // CASO IDEAL: CAMBIO DE CONTRASEÑA EXITOSO
        $User->password = Hash::make($request->post('NewPassword'));
        $User->user_status = 'activo';
        $User->save();

        return redirect()->route('login')->with('success','Contraseña cambiada con éxito');
    }
}
