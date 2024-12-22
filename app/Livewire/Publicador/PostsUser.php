<?php

namespace App\Livewire\Publicador;

use App\Http\Controllers\FindRolController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostsUser extends Component
{
    public $UserPosts = [];
    public $PostCode;
    public $PostSoftDelete;
    public $Modal;

    public function render()
    {
        $this->PostCode ? $this->findPost() : $this->allUserPosts();
        $this->userRol();
        return view('livewire.publicador.posts-user');
    }

    // METODO PARA HAYAR TODAS LAS PUBLICACIONES DEL USUARIO AUTENTICADO
    public function allUserPosts()
    {
        $this->UserPosts = Post::where('fk_user', Auth::id())
            ->orderBy('post_date', 'desc')
            ->get();
    }

    // METODO PARA BUSCAR LA PUBLICACION DEL USUARIO AUTENTICADO
    public function findPost()
    {
        $UnPost = Post::where('post_code', $this->PostCode)
        ->get();

        $this->UserPosts = $UnPost;
    }

    // METODO PARA HAYAR EL ROL DEL USAURIO
    public function userRol()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->findRol();
    }

    // METODO PARA ABRIR EL MODAL DE BORRADO
    public function openAndCloseModal($id_post) 
    {
        $this->PostSoftDelete = Post::find($id_post);
        $this->Modal = !$this->Modal;
    }
}
