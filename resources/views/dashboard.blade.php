<x-LayoutDashboard tittle="Dashboard">

    {{-- PERFIL DEL USUARIO --}}
    @if ($vista === 'profile')
        @livewire('profile-component')
    @endif
    {{-- TODAS LAS PUBLICACIONES (SOLO ADMIN) --}}
    @if ($vista === 'allPosts')
        @livewire('Administrador.all-posts')
    @endif
    {{-- PUBLICACIONES DEL USUARIO AUTENTICADO --}}
    @if ($vista === 'mePosts')
        @livewire('Publicador.posts-user')
    @endif
    {{-- CREAR NUEVAS PUBLICACIONES --}}
    @if ($vista === 'newPost')
        @livewire('Publicador.new-post')
    @endif
    {{-- EDITAR PUBLICACIONES --}}
    @if ($vista === 'editPost')
        @livewire('Publicador.post-edit', ['id_post' => $id_post, 'UserAdmin' => $admin])
    @endif
    {{-- CREAR NUEVO USUARIO (SOLO ADMIN) --}}
    @if ($vista === 'newUser')
        @livewire('Administrador.create-user')
    @endif
    {{-- BLOQUEAR O ELIMINAR USUARIOS (SOLO ADMIN) --}}
    @if ($vista === 'blockAndDeleteUser')
        @livewire('Administrador.block-and-delete-users')
    @endif
    {{-- HISTORIAL DE SESIONES DE TODOS LOS USURIOS (SOLO ADMIN) --}}
    @if ($vista === 'sessionsUsers')
        @livewire('Administrador.sessions-user')
    @endif
    {{-- REALIZAR RESPALDO DE LA BASE DE DATOS (SOLO ADMIN) --}}
    @if ($vista === 'backupDB')
        @livewire('Administrador.backup-data-base')
    @endif

</x-LayoutDashboard>
