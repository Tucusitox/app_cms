<div>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">

    <aside id="sidebar" class="offcanvas offcanvas-start border-2 border-end border-success" data-bs-backdrop="static"
        tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-success mx-2">
                <i class='bx bxs-dashboard'></i>
                {{ $userRol->rol_name }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body scrollSidebar">
            <div class="cont-menu sidebar">
                {{-- VISITANTE --}}
                <div class="sidebarHeader w-100 text-success mb-2 p-2">
                    <a href="{{route('dashboard',['vista'=>'profile'])}}" class="nav-link d-flex align-items-center">
                        <i class='bx bxs-user me-2'></i>
                        <h5 class="mt-2">Mi Perfil</h5>
                    </a>
                </div>
                {{-- PUBLICADOR --}}
                @if ($userRol->rol_name === 'Publicador' || $userRol->rol_name === 'Administrador')
                    <div class="cajaPadre w-100 mb-2">
                        <div class="sidebarHeader d-flex justify-content-between align-items-center text-success p-2">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class='bx bx-news me-2'></i>
                                <h5 class="mt-2">Publicaciones</h5>
                            </a>
                            <i class='bx bxs-down-arrow abrirLista'></i>
                            <i class='bx bxs-up-arrow d-none cerrarLista'></i>
                        </div>

                        <nav class="nav-links d-none opciones">
                            {{-- ADMINISTRADOR --}}
                            @if ($userRol->rol_name === 'Administrador')
                                <a href="{{route('dashboard',['vista'=>'allPosts'])}}"><b>Todas las publicaciones</b></a>
                            @endif
                            <a href="{{route('dashboard',['vista'=>'mePosts'])}}"><b>Mis publicaciones</b></a>
                            <a href="{{route('dashboard',['vista'=>'newPost'])}}"><b>Crear nueva publicación</b></a>
                        </nav>

                    </div>
                @endif
                {{-- ADMINISTRADOR--}}
                @if ($userRol->rol_name === 'Administrador')
                    <div class="cajaPadre w-100">
                        <div class="sidebarHeader d-flex justify-content-between align-items-center text-success p-2">
                            <a href="#" class="nav-link d-flex align-items-center">
                                <i class='bx bxs-cog me-2'></i>
                                <h5 class="mt-2">Opciones Avanzadas</h5>
                            </a>
                            <i class='bx bxs-down-arrow abrirLista'></i>
                            <i class='bx bxs-up-arrow d-none cerrarLista'></i>
                        </div>

                        <nav class="nav-links d-none opciones">
                            <a href="{{route('dashboard',['vista'=>'blockAndDeleteUser'])}}"><b>Gestión de usuarios</b></a>
                            <a href="{{route('dashboard',['vista'=>'newUser'])}}"><b>Crear nuevo usuario</b></a>
                            <a href="{{route('dashboard',['vista'=>'sessionsUsers'])}}"><b>Gestión de sesiones</b></a>
                            <a href="{{route('dashboard',['vista'=>'backupDB'])}}"><b>Copia de seguridad</b></a>
                        </nav>

                    </div>
                @endif
            </div>
        </div>
        <div class="card-footer bg-transparent border-success m-3 text-end">
            <form action="{{ route('logout.index') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger" type="submit">
                    <i class='bx bx-log-out'></i>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>
    
    <script src="{{asset('js/sidebar.js')}}"></script>
</div>
