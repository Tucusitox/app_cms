<?php

namespace App\Livewire\Administrador;

use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\FindRolController;
use App\Models\SessionsUser as AllSessionsUser;
use Livewire\Component;

class SessionsUser extends Component
{
    public $AllSessions = [];
    public $UserId;
    public $SessionDate;
    public $sessions;

    public function render()
    {
        $this->sessions ? $this->findSession() : $this->allSessions();
        $this->userRol();
        return view('livewire.administrador.sessions-user');
    }

    // METODO PARA HALLAR TODAS LAS SESSIONS DE LOS USUARIOS
    public function allSessions()
    {
        $this->AllSessions = AllSessionsUser::join('users','users.user_id','=','sessions_users.fk_user')
        ->orderBy('session_date', 'desc')
        ->get();
    }

    // METODO PARA BUSCAR UNA O VARIAS SESIONES
    public function findSession()
    {
        // BUSCAR TODAS LAS SESIONES EN UNA FECHA ESPECIFICA
        if (!$this->UserId) {

            $this->sessions =  AllSessionsUser::join('users','users.user_id','=','sessions_users.fk_user')
            ->Where('session_date', $this->SessionDate)
            ->orderBy('session_date', 'desc')
            ->get(); 
            $this->AllSessions = $this->sessions;
        }
        // BUSCAR SESSIONES DE UN USUARIO EN UNA FECHA ESPECIFICA
        elseif ($this->UserId && $this->SessionDate) {
            $this->sessions =  AllSessionsUser::join('users','users.user_id','=','sessions_users.fk_user')
            ->where('fk_user', $this->UserId)
            ->Where('session_date', $this->SessionDate)
            ->orderBy('session_date', 'desc')
            ->get(); 
            $this->AllSessions = $this->sessions;
        }
        // BUSCAR LA SESSIONES DE UN USUARIO ESPECIFICO
        else {
            $this->sessions =  AllSessionsUser::join('users','users.user_id','=','sessions_users.fk_user')
            ->where('fk_user', $this->UserId)
            ->orderBy('session_date', 'desc')
            ->get(); 
            $this->AllSessions = $this->sessions;
        }
    }

    // METODO PARA HALLAR EL ROL DEL USAURIO
    public function closeSessionUser($user_id)
   {
        $CloseSession = new LogoutController;
        $CloseSession->closeSession($user_id);
        session()->flash('success', 'Sesión cerrada con éxito');
    }

    // METODO PARA BUSCAR TODAS LAS SESIONES DESDE UN BOTON
    public function callAllSessions()
    {
        $this->sessions = null;
        $this->UserId = "";
        $this->SessionDate = "";
    }

    // METODO PARA HALLAR EL ROL DEL USAURIO
    public function userRol()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->adminRol();
    }
}
