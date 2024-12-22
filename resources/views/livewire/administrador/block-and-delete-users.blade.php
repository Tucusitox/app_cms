<div>

    <section class="container-fluid p-4">

        <div class="row">
            <div class="col-12">
                <div class="card border border-success">

                    {{-- BUSCADOR POR CODIGO --}}
                    <div class="row card-header d-flex justify-content-between py-4">

                        <div class="col-lg-8 text-success mb-2">
                            <h3>Todas los usuarios del sistema</h3>
                        </div>
                        <div class="card-tools col-lg-4">
                            {{-- INPUT BUSCAR POR CODIGO --}}
                            <div class="input-group rounded">
                                <input type="search" type="text"
                                    class="form-control border border-success rounded-start text-success"
                                    placeholder="Buscar usuario por ID" aria-label="Search"
                                    aria-describedby="search-addon" id="SearchId" wire:model.live='IdUser' />
                                <span class="input-group-text border-0 bg-success">
                                    <i class='bx bx-search'></i>
                                </span>
                            </div>
                        </div>

                    </div>

                    {{-- ALERTA CUANDO SE ACTUALICE UNA PUBLICACION --}}
                    @if (session('success'))
                        <x-AlertaMensaje typeAlert="alert-success" styleText="text-start m-3"
                            mensaje="{{ session('success') }}" />
                    @endif

                    {{-- MENSAJE DE PROCESANDO BUSQUEDA --}}
                    <div class="alert alert-info m-3" wire:loading wire:target='IdUser'>
                        <h5><i class="spinner-border me-2" role="status"></i>Buscando</h5>
                    </div>

                    {{-- MENSAJE DE PROCESANDO BLOQUEO --}}
                    <div class="alert alert-info m-3" wire:loading wire:target='blockUser'>
                        <h5><i class="spinner-border me-2" role="status"></i>Espere un momento</h5>
                    </div>

                    {{-- MENSAJE DE PROCESANDO BLOQUEO --}}
                    <div class="alert alert-info m-3" wire:loading wire:target='unlockUser'>
                        <h5><i class="spinner-border me-2" role="status"></i>Espere un momento</h5>
                    </div>

                    {{-- MOSTRAR LAS PUBLICACIONES --}}
                    <div class="card-body table-responsive table-container p-0" style="max-height: 500px;">

                        <table class="table table-head-fixed text-nowrap">

                            @if ($AllUsers->isEmpty())
                                <tr class="text-danger text-center w-100">
                                    <td colspan="8"><b>Este usuario no existe en el sistema</b></td>
                                </tr>
                            @endif

                            <thead class="bg-body text-success border-top border-bottom border-success">
                                <tr>
                                    <th>Id usuario</th>
                                    <th>Rol</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Estatus</th>
                                    <th class="text-center">Opciones avanzadas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AllUsers as $item)
                                    <tr class="text-secondary-emphasis">
                                        <td class="text-center">{{ $item->user_id }}</td>
                                        <td>{{ $item->rol_name }}</td>
                                        <td>{{ $item->user_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->user_status }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info me-2"
                                                wire:click='openAndCloseModal("rol", {{ $item->user_id }})'>
                                                <i class='bx bx-loader-circle'></i>
                                                Cambiar rol
                                            </a>
                                            @if ($item->user_status === 'bloqueado')
                                                <a class="btn btn-outline-warning me-2"
                                                    wire:click='unlockUser( {{ $item->user_id }} )'>
                                                    Desbloquear
                                                </a>
                                            @else
                                                <a class="btn btn-warning me-2"
                                                    wire:click='blockUser( {{ $item->user_id }} )'>
                                                    <i class='bx bx-block'></i>
                                                    Bloquear
                                                </a>
                                            @endif
                                            <a class="btn btn-danger"
                                                wire:click='openAndCloseModal( "eliminar", {{ $item->user_id }} )'>
                                                <i class='bx bxs-trash'></i>
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>

    {{-- MODAL PARA CAMBIAR ROL DE UN USUARIO --}}
    @if ($ModalDelete)
        <x-ModalDeleteUser idUser="{{ $UserRolId->user_id }}" userName="{{ $UserRolId->user_name }}" />
    @endif

    {{-- MODAL PARA CAMBIAR ROL DE UN USUARIO --}}
    @if ($ModalRol)
        <div class="modal fade show d-block" id="modalPorInactividad" style="backdrop-filter: blur(0.4rem);"
            aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content border border-2 border-success text-center p-4">

                    <h4 class="text-success my-4">
                        Seleccione el cambio de rol para:
                        <span class="text-danger">{{ $UserRolId->user_name }}</span>
                    </h4>

                    {{-- MENSAJE DE PROCESANDO CAMBIO DE ROL --}}
                    <div class="alert alert-warning" wire:loading wire:target='changeRol'>
                        <h5><i class="spinner-border me-2" role="status"></i>Procesando cambio</h5>
                    </div>

                    <form wire:submit='changeRol( {{ $UserRolId->user_id }} )'>
                        {{-- INPUTS CHECKBOK --}}
                        <div class="checkBox mb-2 py-2">
                            <div class="row d-flex justify-content-start radio">
                                @foreach ($AllRols as $item)
                                    <div class="col-lg-4 text-center">
                                        <input type="radio" id="{{ $item->rol_name }}" name="rol"
                                            value="{{ $item->id_rol }}" wire:model="RolChange">
                                        <label for="{{ $item->rol_name }}"><b>{{ $item->rol_name }}</b></label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <button type="button" class="btn btn-danger me-2"
                                wire:click='openAndCloseModal("rol", {{ $UserRolId->user_id }} )'>
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-success">Cambiar rol</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif


    {{-- ESTILOS DE LA TABLA --}}
    <style>
        input[id="SearchId"]::placeholder {
            color: green;
        }

        thead {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        tbody tr:hover {
            background: #1c632d;
            cursor: pointer;
        }

        .table-container::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: #28a745;
            border-radius: 5px;
        }
    </style>

</div>
