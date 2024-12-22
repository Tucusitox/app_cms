<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'post_code' => strtoupper(Str::random(6)),
            'post_img' => $rutaFinalImg,
            'post_tittle' => $request->post('PostTittle'),
            'post_body' => $request->post('PostBody'),
            'post_date' => now()->setTimezone('America/Caracas'),
        ]);

        return redirect()->route('dashboard',['vista'=>'newPost'])->with('success','Publicación creada con éxito');
    }

    // METODO PARA ACTUALIZAR UNA PUBLICACION
    public function editpost(Request $request, $id_post, $admin = null)
    {
        $request->validate([
            'PostImg'=>'image|max:2024',
            'PostTittle'=>'required|string|min:6',
            'PostBody'=>'required|string|min:500',
        ]);

        // BUSCAMOS LA PUBLICACION A EDITAR
        $PostUpdate = Post::find($id_post);

        // PROCESAMOS LA IMAGEN ENVIADA POR EL USUARIO EN CASO DE QUE ENVIE UNA NUEVA
        if ($request->file("PostImg") && $PostUpdate->post_img) {

            unlink($PostUpdate->post_img); //-> ELMINAMOS LA IMG EXISTENTE PARA AHORRAR ESPACIO
            $foto = $request->file("PostImg");
            $destinoCarpeta = "img/imgPosts";
            $rutaImg = "/" . $foto->getClientOriginalName();
            $request->file("PostImg")->move($destinoCarpeta, $rutaImg);
            $PostUpdate->post_img = $destinoCarpeta . $rutaImg; //DEFINIMOS LA NUEVA RUTA DE LA IMAGEN
        }

        // GENERAMOS EL UPDATE EN LA TABLA "posts"
        $PostUpdate->post_tittle = $request->post('PostTittle');
        $PostUpdate->post_body = $request->post('PostBody'); 
        $PostUpdate->save();

        if ($admin != null) {
            return redirect()->route('dashboard',['vista'=>'allPosts'])->with('success','Publicación editada con éxito');
        }
        return redirect()->route('dashboard',['vista'=>'mePosts'])->with('success','Publicación editada con éxito');
    }

    // METODO PARA BORRADO LOGICO DE LA PUBLICACION
    public function softDeletePost($id_post)
    {
        Post::find($id_post)->delete();
        return redirect()->route('dashboard',['vista'=>'mePosts'])->with('success','Publicación eliminada con éxito');
    }

    // METODO PARA BORRADO FISICO DE LA PUBLICACION
    public function destroyPost(Request $request, $id_post)
    {
        $request->validate([
            'AdminPassword' => 'required|string|min:8',
        ]);

        $UserAuth = User::where('user_id', Auth::id())->first();

        if (!Hash::check($request->post('AdminPassword'), $UserAuth->password)) {
            return redirect()->route('dashboard',['vista'=>'allPosts'])->with('danger','Contraseña incorrecta');
        }
        //REALIZAMOS EL BORRADO FISICO EN LA TABLA
        $PostDelete = Post::withTrashed()->find($id_post);
        unlink($PostDelete->post_img);
        $PostDelete->forceDelete();
        
        return redirect()->route('dashboard',['vista'=>'allPosts'])->with('success','Publicación eliminada con éxito');
    }
}
