<?php

namespace App\Livewire\Administrador;

use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\FindRolController;
use App\Models\Post;
use App\Models\Rol;
use App\Models\Session;
use App\Models\SessionsUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class BlockAndDeleteUsers extends Component
{
    public $AllUsers = [];
    public $AllRols = [];
    public $IdUser;
    public $ModalRol;
    public $ModalDelete;
    public $UserRolId;
    public $RolChange;
    public $AdminPassword;

    public function render()
    {
        $this->IdUser ? $this->findUser() : $this->allUsers();;
        $this->userRol();
        return view('livewire.administrador.block-and-delete-users');
    }

    // METODO PARA HALLAR TODOS LOS USUARIOS DEL SISTEMA
    public function allUsers()
    {
        $this->AllUsers = User::join('rols', 'rols.id_rol', '=', 'users.fk_rol')
            ->orderBy('user_name', 'asc')
            ->get();
    }

    // METODO PARA BUSCAR UN USUARIO POR ID
    public function findUser()
    {
        $UnUser = User::join('rols', 'rols.id_rol', '=', 'users.fk_rol')
            ->where('user_id', $this->IdUser)
            ->get();

        $this->AllUsers = $UnUser;
    }

    // METODO PARA BLOQUEAR A UN USUARIO DEL SISTEMA
    public function blockUser($user_id)
    {
        // BLOQUEAMOS AL USUARIO
        $UserBlock = User::find($user_id);
        $UserBlock->user_status = "bloqueado";
        $UserBlock->save();

        // CERRAMOS LA SESION DEL USUARIO EN CASO DE QUE TENGA ALGUNA ACTIVA
        if (SessionsUser::where('fk_user', $user_id)->where('session_status', 'activo')->exists()) {
            $FindRolUser = new LogoutController;
            $FindRolUser->closeSession($user_id);
        }

        session()->flash('success', 'Usuario bloqueado con éxito');
    }
    // METODO PARA DESBLOQUEAR UN USUARIO
    public function unlockUser($user_id)
    {
        $UserUnlock = User::find($user_id);
        $UserUnlock->user_status = "activo";
        $UserUnlock->save();
        session()->flash('success', 'Usuario desbloqueado con éxito');
    }

    // METODO PARA HAYAR EL ROL DEL USAURIO
    public function userRol()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->adminRol();
    }

    // METODO PARA ABRIR EL MODAL DE CAMBIO DE ROL O BORRADO
    public function openAndCloseModal($param, $user_id=null)
    {
        $this->UserRolId = User::find($user_id);

        if ($param === "rol") {
            $this->ModalRol = !$this->ModalRol;
            $this->AllRols = Rol::all();
        }

        if ($param === "eliminar") {
            $this->ModalDelete = !$this->ModalDelete;
            $this->AdminPassword = "";
        }
    }

    // METODO PARA CAMBIAR EL ROL DEL USUARIO
    public function changeRol($user_id)
    {
        // CAMBIAMOS EL ROL CON UN UPDATE A LA TABLA "users.fk_user"
        $User = User::find($user_id);
        $User->fk_rol = $this->RolChange;
        $User->save();

        $this->openAndCloseModal("rol", $user_id);
        session()->flash('success', 'Cambio de rol exitoso');
    }

    // METODO PARA BORRADO FISICO DE UN USUARIO
    public function destroyUser($user_id)
    {
        $this->validate([
            'AdminPassword' => 'required|string|min:8',
        ]);

        // VALIDAMOS LA CONTRASEÑA DE ADMINISTRADOR
        $UserAdmin = User::find(Auth::id());
        
        if (!Hash::check($this->AdminPassword, $UserAdmin->password)) {
            $this->AdminPassword = "";
            session()->flash('danger', 'Contraseña incorrecta');
        } 
        else {
            // CAPTURAMOS LAS PUBLICACIONES Y SESIONES ASOCIADOS AL USAURIO
            $UserPosts = Post::withTrashed()->where('fk_user', $user_id)->get();
            $UserSessions = SessionsUser::where('fk_user', $user_id)->get(); 
            $UserDelete = User::find($user_id);

            // REALIZAMOS EL BORRADO FISICO EN LA TABLA "users"
            foreach ($UserPosts as $post) {
                $post->forceDelete(); 
            }
            foreach ($UserSessions as $session) {
                $session->delete();
            }
            Session::where('user_id', $user_id)->delete();
            $UserDelete->delete();

            $this->openAndCloseModal("eliminar", null);
            session()->flash('success', 'Usuario eliminado con éxito');
        }
    }
}
