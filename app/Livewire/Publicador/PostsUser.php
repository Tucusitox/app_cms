<?php

namespace App\Livewire\Publicador;

use App\Http\Controllers\FindRolController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostsUser extends Component
{
    public function render()
    {
        $FindRolUser = new FindRolController;
        $FindRolUser->findRol();
        return view('livewire.publicador.posts-user');
    }
}
