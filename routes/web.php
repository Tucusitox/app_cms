<?php

use App\Http\Controllers\auth\AutenticationController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RecuperarContrasena;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CrudPostController;
use App\Http\Controllers\FindRolController;
use App\Http\Middleware\sessionInactiva;
use App\Models\Post;
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

    // RUTA DE CONTACTO DE CLEINTES
    Route::post('/contactanos/correo', [ContactController::class, 'contactSend'])->name('contact.send');
});

// RUTAS PARA DEVOLVER VISTAS BLADE (LOGIN, REGISTER):
// LOGIN
Route::get('/iniciar', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
})->name('login');

// REGISTER
Route::get('/registrar', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.register');
})->name('register');

// RUTAS DE AUTENTICACION, REGISTRO, RECUPERACION DE CONTRASEÑA DE USUARIOS
Route::post('/autenticar', [AutenticationController::class, 'autenticar'])->name('autenticar.index');
Route::post('/recuperar', [RecuperarContrasena::class, 'store'])->name('recuperar.store');
Route::get('/recuperar/confirm/{id_user}', [RecuperarContrasena::class, 'recoverIndex'])->name('recuperar.index');
Route::post('/contrasena/nueva/{id_user}', [RecuperarContrasena::class, 'newPassword'])->name('contraseña.nueva');

// RUTAS PROTEGIDAS POR MIDDELEWARE (DASHBOARD, CIERRE DE SESION)
Route::middleware(['auth', sessionInactiva::class])->group(function () {

    // DASHBOARD ($vista ES HEREDADA DE LA RUTA rol.index)
    Route::get('/dashboard/{vista}', function ($vista) {
        return view('dashboard', compact('vista'));
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
});
