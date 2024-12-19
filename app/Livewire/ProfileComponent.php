<?php

namespace App\Livewire;

use App\Models\Rol;
use App\Models\SessionsUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfileComponent extends Component
{
    public $profileUser;
    public $permissionsUser;
    public $sessionsUser;
    public $userName;
    public $newPassword;
    public $confirmPassword;

    public function render()
    {   
        $this->profileUser = User::join('rols', 'users.fk_rol', '=', 'rols.id_rol')
        ->where('user_id', Auth::id())
        ->first();

        $this->permissionsUser = Rol::select('permission_name')
        ->join('rols_x_permissions', 'rols.id_rol', '=', 'rols_x_permissions.fk_rol')
        ->join('permissions', 'permissions.id_permission', '=', 'rols_x_permissions.fk_permission')
        ->where('rols_x_permissions.fk_rol', $this->profileUser->id_rol)
        ->groupBy('rols_x_permissions.fk_permission')
        ->get();

        $this->sessionsUser = SessionsUser::where('fk_user',Auth::id())
        ->orderBy('id_sessionUser', 'desc')
        ->get();
        
        return view('livewire.profile-component');
    }
    // METODO PARA ACTUALIZAR DATOS DEL USUARIO
    public function updateDataUser()
    {
        $this->validate(
            [
                'newPassword' => 'required|string|min:8',
                'confirmPassword' => 'required|string|min:8',
            ]
        );

        $newName ='';
        if ($this->userName == null) {
            $newName = $this->userName = $this->profileUser->user_name; 
        }
        else {
            $newName = $this->userName;
        }

        if ($this->newPassword === $this->confirmPassword) {

            User::where('user_id', Auth::id())
            ->update(
                [
                    'user_name' => $newName,
                    'password' => Hash::make($this->newPassword),
                ],
            );

            $this->clearForm();
            session()->flash('success', 'Contraseña actualizada con éxito');
        }
        else{
            session()->flash('danger', 'Las contraseñas con coinciden');
        } 
    }
    //METODO PARA LIMPIAR CAMPOS DEL FORMULARIO
    private function clearForm()
    {
        $this->userName = "";
        $this->newPassword = "";
        $this->confirmPassword = "";
    }
}
