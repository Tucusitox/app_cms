<?php

namespace App\Http\Controllers\auth;

use App\Models\SessionsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LogoutController;

class AutenticationController
{
    // METODO DE AUTENTICACION
    public function autenticar(Request $request)
    {
        // OBTENER LAS CREDENCIALES DE ACCESO Y VALIDARLAS
        $credentials = $request->validate([
            'email' => 'required|string|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/',
            'password' => 'required|string|min:8',
        ]);
        // CASO 1: EVALUAR SI EXISTE ALGUNA SESIÓN ABIERTA EN EL NAVEGADOR
        if (Auth::check()) {
            return redirect()->route('login')->with('danger', 'Ya existe una Sesión Activa en el Navegador');
        }
        // CASO 1: SI LAS CREDENCIALES SON INCORRECTAS REDIRIGIR AL USUARIO AL LOGIN
        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->with('danger', 'Correo o contraseña incorrectos');
        }
        // CASO 2: VALIDAR SI EL CORREO ESTA VERIFICADO
        if (Auth::user()->email_verified !== 'true') {
            $LogoutController = new LogoutController;
            $LogoutController->logoutAndRedirect($request);
            return redirect()->route('correo.confirm', ['id_user' => Auth::user()->user_id]);
        }

        // CASO 3: VALIDAR SI YA TIENE UNA SESION ACTIVA
        if (SessionsUser::where('fk_user', Auth::id())->where('session_status', 'activo')->exists()) {
            $LogoutController = new LogoutController;
            $LogoutController->logoutAndRedirect($request);
            return redirect()->route('login')->with('danger', 'Este usuario tiene una sesión activa en el sistema');
        }

        $this->crearSession();
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    // METODO PARA REGISTRAR LA SESION DEL USUARIO
    public function crearSession()
    {
        SessionsUser::create([
            'fk_user' => Auth::id(),
            'session_date' => now()->setTimezone('America/Caracas')->format('Y-m-d'),
            'session_time_start' => now()->setTimezone('America/Caracas')->format('H:i:s'),
            'session_time_closing' => null,
            'session_duration' => null,
            'session_status' => 'activo',
        ]);
    }
}