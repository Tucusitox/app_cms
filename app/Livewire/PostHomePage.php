<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostHomePage extends Component
{
    public $Posts;
    public $FindPost;
    public $Modal = false;

    public function render()
    {
        $this->Posts = Post::orderBy('id_post', 'desc')->get();
        return view('livewire.post-home-page');
    }

    public function showPost($id_post)
    {
        $this->FindPost = Post::where('id_post',$id_post)->first();
        $this->openAndCloseModal();
    }

    public function openAndCloseModal(){
        $this->Modal = !$this->Modal;
    }
}
