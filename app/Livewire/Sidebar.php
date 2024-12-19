<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public $userRol;

    public function render()
    {
        $this->userRol = User::join('rols','users.fk_rol','=','rols.id_rol')
        ->where('user_id', Auth::id())
        ->first();
        return view('livewire.sidebar');
    }
}
