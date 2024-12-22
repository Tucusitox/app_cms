<?php

namespace App\Livewire\Administrador;

use App\Http\Controllers\FindRolController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AllPosts extends Component
{
    public $AllPosts = [];
    public $PostCode;
    public $PostDelete;
    public $Modal;

    public function render()
    {
        $this->PostCode ? $this->findPost() : $this->allPosts();
        $this->userRol();
        return view('livewire.administrador.all-posts');
    }

    // METODO PARA HALLAR TODAS LAS PUBLICACIONES DEL USUARIO AUTENTICADO
    public function allPosts()
    {
        $this->AllPosts = Post::join('users','users.user_id','=','posts.fk_user')
        ->withTrashed()
        ->orderBy('post_date', 'desc')
        ->get();
    }

    // METODO PARA BUSCAR LA PUBLICACION DEL USUARIO AUTENTICADO
    public function findPost()
    {
        $UnPost = Post::withTrashed()->where('post_code', $this->PostCode)
        ->get();

        $this->AllPosts = $UnPost;
    }

    // METODO PARA HAYAR EL ROL DEL USAURIO
    public function userRol()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->adminRol();
    }

    // METODO PARA ABRIR EL MODAL DE BORRADO
    public function openAndCloseModal($id_post) 
    {
        $this->PostDelete = Post::withTrashed()->find($id_post);
        $this->Modal = !$this->Modal;
    }
}
