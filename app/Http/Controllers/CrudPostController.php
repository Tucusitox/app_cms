<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrudPostController
{
    // METODO PARA CREAR NUEVO POST
    public function newPost(Request $request)
    {
        $request->validate([
            'PostImg'=>'required|image|max:2024',
            'PostTittle'=>'required|string|min:6',
            'PostBody'=>'required|string|min:500',
        ]);

        // PROCESAMOS LA IMAGEN ENVIADA POR EL USUARIO
        $foto = $request->file("PostImg");
        $destinoCarpeta = "img/imgPosts";
        $rutaImg = "/" . $foto->getClientOriginalName();
        $request->file("PostImg")->move($destinoCarpeta, $rutaImg);
        $rutaFinalImg = $destinoCarpeta . $rutaImg; //DEFINIMOS LA RUTA DE LA IMAGEN

        // GUARDAMOS EN LA BASE DE DATOS
        Post::insert([
            'fk_user' => Auth::id(),
            'post_img' => $rutaFinalImg,
            'post_tittle' => $request->post('PostTittle'),
            'post_body' => $request->post('PostBody'),
            'post_date' => now(),
        ]);

        return redirect()->route('dashboard',['vista'=>'newPost'])->with('success','Publicación creada con éxito');
    }
}
