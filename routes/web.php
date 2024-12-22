<?php

use App\Http\Controllers\auth\AutenticationController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\NewPasswordController;
use App\Http\Controllers\auth\RecuperarContrasena;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CrudPostController;
use App\Http\Middleware\sessionInactiva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// RUTAS PARA DEVOLVER VISTAS BLADE (HOMEPAGE, POSTS, CONTACT FORM):
Route::middleware([sessionInactiva::class])->group(function () {
    // HOMEPAGE
    Route::get('/', function () {
        return view('welcome');
    })->name('home');
    
    // POSTS PAGE
    Route::get('/noticias', function () {
        return view('postsHomePage');
    })->name('noticias');

    // CONTACT FORM PAGE
    Route::get('/contactanos', function () {
        return view('contactPage');
    })->name('contactanos');

    // RUTA DE CONTACTO DE CLINTES
    Route::post('/contactanos/correo', [ContactController::class, 'contactSend'])->name('contact.send');
});

// RUTAS PARA DEVOLVER VISTAS BLADE (LOGIN, REGISTER):
// LOGIN
Route::get('/iniciar/{verifiedEmailSuccess?}', function ($verifiedEmailSuccess = null) {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login', compact('verifiedEmailSuccess'));
})->name('login');
// REGISTER
Route::get('/registrar', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.register');
})->name('register');
// CAMBIO DE CONTRASEÑA DE UN USUARIO CREADO POR UN ADMINISTRADOR
Route::get('/newpassword/{id_user}', function ($id_user) {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.newPassword', compact('id_user'));
})->name('newpassword');

// RUTAS DE AUTENTICACION, REGISTRO, RECUPERACION DE CONTRASEÑA DE USUARIOS
Route::post('/autenticar', [AutenticationController::class, 'autenticar'])->name('autenticar.index');
Route::post('/registrar', [RegisterController::class, 'registrar'])->name('registrar.index');
Route::get('/verificar/{token}', [RegisterController::class, 'verificar'])->name('register.verifified');
Route::post('/recuperar', [RecuperarContrasena::class, 'store'])->name('recuperar.store');
Route::get('/recuperar/confirm/{id_user}', [RecuperarContrasena::class, 'recoverIndex'])->name('recuperar.index');
Route::post('/contrasena/nueva/{id_user}', [RecuperarContrasena::class, 'newPassword'])->name('contraseña.nueva');
Route::post('/nueva/contrasena/{id_user}', [NewPasswordController::class, 'store'])->name('contraseña.store');

// RUTAS PROTEGIDAS POR MIDDELEWARE (DASHBOARD, CIERRE DE SESION)
Route::middleware(['auth', sessionInactiva::class])->group(function () {

    // DASHBOARD 
    // ($vista ES HEREDADA DE LA RUTA rol.index) 
    // ($id_post HEREDADA DEL COMPONENTE PostsUser)
    // ($admin HEREDADA DEL COMPONENTE AllPosts)
    Route::get('/dashboard/{vista}/{id_post?}/{admin?}', 
        function ($vista, $id_post = null, $admin = null) {
        return view('dashboard', compact('vista','id_post','admin'));
    })->name('dashboard');

    // CERRAR SESION
    Route::post('/cerrar', [LogoutController::class, 'logout'])->name('logout.index');

    // RUTA PARA ACTUALIZAR LA SESION CUANDO EL USUARIO INTERACTUE CON LA APP
    Route::post('/actualizarSesion', function () {
        session()->put('ultimaActividad', time());
        return response()->json(['ultimaActividad' => session('ultimaActividad')]);
    });

    // RUTAS PARA CRURD PUBLICACIONES
    Route::post('/newpost', [CrudPostController::class, 'newPost'])->name('newpost.index');
    Route::put('/editpost/{id_post}/{admin?}', [CrudPostController::class, 'editPost'])->name('editpost.index');
    Route::delete('/deletepost/{id_post}', [CrudPostController::class, 'softDeletePost'])->name('deletepost.index');
    Route::delete('/destroypost/{id_post}', [CrudPostController::class, 'destroyPost'])->name('destroypost.index');
});
