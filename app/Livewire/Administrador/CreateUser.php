<?php

namespace App\Livewire\Administrador;

use App\Http\Controllers\FindRolController;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class CreateUser extends Component
{
    public $UserName;
    public $UserEmail;
    public $UserPassword = "12345678"; //-> DEFAULT EL USER DEBE CAMBIARLA ANTES DE INCIAR SESION
    public $UserRol;
    public $AllRols;

    public function render()
    {   
        $this->allRols();
        $this->userRol();
        return view('livewire.administrador.create-user');
    }
    // METODO PARA CREAR NUEVO USUARIO DESDE EL ROL ADMINISTRADOR
    public function createUser()
    {
        $this->validate([
            'UserName' => 'required|string|min:4',
            'UserEmail' => 'required|string|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/',
            'UserPassword' => 'required|string|min:8',
            'UserRol' => 'required|in:1,2,3',
        ]);    
        // GENERAMOS EL INSERT EN AL TABLA "users"
        User::insert([
            'fk_rol' => $this->UserRol,
            'user_name' => $this->UserName,
            'email' => $this->UserEmail,
            'password' => Hash::make($this->UserPassword),
            'email_verified' => 'true',
            'user_token' => Str::random(50),
            'user_status' => null,
        ]);

        // LIMPIAMOS LOS CAMPOS
        $this->UserName = "";
        $this->UserEmail = "";
        $this->UserRol = "";

        session()->flash('success', 'Usuario creado con éxito');
    }
    // METODO PARA CARGAR TODOS LOS ROLES EXISTENTES
    public function allRols()
    {
        $this->AllRols = Rol::all();
    }
    // METODO PARA HAYAR EL ROL DEL USAURIO
    public function userRol()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->adminRol();
    }
}
