<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FindRolController
{
    // METODO AUXILIAR PARA PROTEGER LAS RUTAS DEPENDIENDO DE LOS ROLES
    // ESTE METODO PUEDE SER INVOCADO SIN NINGUN PARAMETRO
    // ESTE METODO ES PARA SER APLICADO EN LOS COMPONENTES DE LIVEWIRE DE LA RUTA DASHBOARD
    // NO MANIPULAR SIN CONSULTARME
    
    public function findRol()
    {
        $RolUser = User::join('rols', 'users.fk_rol', '=', 'rols.id_rol')
        ->where('user_id', Auth::id())
        ->first();

        if ($RolUser->rol_name !== "Publicador" && $RolUser->rol_name !== "Administrador") {
            return redirect()->route('dashboard', ['vista' => 'profile']);
        }
    }
}