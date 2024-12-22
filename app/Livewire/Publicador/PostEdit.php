<?php

namespace App\Livewire\Publicador;

use App\Http\Controllers\FindRolController;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class PostEdit extends Component
{
    // ESTE ARCHIVO SOLO SE ENCARGA DE EVALUAR EL ROL DEL USUARIO
    // LA LOGICA PARA CRUD DE PUBLICACIONES SE ENCUENTRA EN
    // App\Http\Controllers\CrudPostController;

    public $id_post;
    public $UserAdmin = 'false';
    public $PostEdit;

    public function render()
    {
        $this->userRol();
        $this->editPostUser();
        return view('livewire.publicador.post-edit');
    }

    // METODO PARA BUSCAR LA PUBLICACION A EDITAR
    public function editPostUser()
    {
        $this->PostEdit = Post::where('id_post', $this->id_post)->first();
    }

    // METODO PARA HAYAR EL ROL DEL USAURIO
    public function userRol()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->findRol();
    }
}
