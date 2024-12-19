<?php

namespace App\Livewire\Publicador;

use App\Http\Controllers\FindRolController;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewPost extends Component
{
    // ESTE ARCHIVO SOLO SE ENCARGA DE EVALUAR EL ROL DEL USUARIO
    // LA LOGICA PARA CRUD DE PUBLICACIONES SE ENCUENTRA EN
    // App\Http\Controllers\CrudPostController;

    public function render()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->findRol();
        return view('livewire.publicador.new-post');
    }
}
