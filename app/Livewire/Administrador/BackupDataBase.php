<?php

namespace App\Livewire\Administrador;

use App\Http\Controllers\FindRolController;
use App\Jobs\BackupDatabaseJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class BackupDataBase extends Component
{
    public $AdminPassword;

    public function render()
    {
        $this->userRol();
        return view('livewire.administrador.backup-data-base');
    }

    // METODO PARA HAYAR EL ROL DEL USAURIO
    public function userRol()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->adminRol();
    }

    // METODO PARA GENERAR EL BACKUP DE LA BASE DE DATOS
    public function backup()
    {
        $this->validate([
            'AdminPassword' => 'required|string|min:8',
        ]);

        $UserAuth = User::find(Auth::id());

        // EVALUAMOS SI LA CONTRASEÑA ES ERRONEA
        if (!Hash::check($this->AdminPassword, $UserAuth->password)) {
            $this->AdminPassword = "";
            session()->flash('danger', 'Contraseña incorrecta');
        } 
        else {
            // GENERAMOS EL BACKUP DE LA BASE DE DATOS DESPACHANDOLO EN UN JOB
            BackupDatabaseJob::dispatch();
            $this->AdminPassword = "";
            session()->flash('success', 'Copia de seguridad generada con éxito');
        }
    }
}
