<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nadbar extends Component
{
    public $user;
    
    public function render()
    {
        $this->user = User::where('user_id', Auth::id())->first();
        return view('livewire.nadbar');
    }
}
