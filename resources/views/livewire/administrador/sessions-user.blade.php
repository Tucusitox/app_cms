<div>

    <section class="container-fluid p-4">

        <div class="row">
            <div class="col-12">
                <div class="card border border-success">

                    {{-- BUSCADOR POR CODIGO --}}
                    <div class="row card-header d-flex justify-content-between py-4">

                        <div class="col-lg-4 text-success mb-2">
                            <h3>Todas las sesiones de usuarios</h3>
                        </div>

                        <div class="col d-flex align-items-center m-2">
                            <button type="buttom" class="btn btn-outline-success" wire:click='callAllSessions'>Todas las sesiones</button>
                        </div>

                        <form class="card-tools col-lg-6 d-flex align-items-center" wire:submit='findSession'>
                            {{-- INPUT BUSCAR FECHA --}}
                            <div class="input-group rounded mx-2">
                                <input type="date"
                                    class="form-control border border-success rounded-start text-success"
                                    placeholder="Buscar por código" aria-label="Search" aria-describedby="search-addon"
                                    wire:model='SessionDate' />
                            </div>
                            {{-- INPUT BUSCAR POR ID DE USUARIO --}}
                            <div class="input-group rounded me-2">
                                <input type="text"
                                    class="form-control border border-success rounded-start text-success"
                                    placeholder="Id de usuario" aria-label="Search" aria-describedby="search-addon"
                                    id="searchIdUser" wire:model='UserId' />
                            </div>

                            <button type="submit" class="btn btn-success">Buscar</button>
                        </form>

                    </div>

                    {{-- ALERTA CUANDO SE ACTULICE UNA PUBLICACION --}}
                    @if (session('success'))
                        <x-AlertaMensaje typeAlert="alert-success" styleText="text-start m-3"
                            mensaje="{{ session('success') }}" />
                    @endif

                    {{-- MENSAJE DE PROCESANDO PARA BUSCAR UNA SESSION --}}
                    <div class="alert alert-warning m-3" wire:loading wire:target='findSession'>
                        <h5><i class="spinner-border me-2" role="status"></i>Buscando</h5>
                    </div>

                    {{-- MENSAJE DE PROCESANDO PARA BUSCAR TODAS LAS SESSIONES --}}
                    <div class="alert alert-warning m-3" wire:loading wire:target='callAllSessions'>
                        <h5><i class="spinner-border me-2" role="status"></i>Buscando</h5>
                    </div>

                    {{-- MENSAJE DE PROCESANDO CUANDO DE CIERRE UNA SESION DE UN USUARIO --}}
                    <div class="alert alert-warning m-3" wire:loading wire:target='closeSessionUser'>
                        <h5><i class="spinner-border me-2" role="status"></i>Procesando</h5>
                    </div>

                    {{-- MOSTRAR LAS PUBLICACIONES --}}
                    <div class="card-body table-responsive table-container p-0" style="max-height: 500px;">

                        <table class="table table-head-fixed text-nowrap">

                            @if ($AllSessions->isEmpty())
                                <tr class="text-danger text-center w-100">
                                    <td colspan="8"><b>No se encontraron sesiones</b></td>
                                </tr>
                            @endif

                            <thead class="bg-body text-success border-top border-bottom border-success">
                                <tr>
                                    <th>Id del usuario</th>
                                    <th>Usuario</th>
                                    <th>Estatus de conexión</th>
                                    <th>Fecha de la conexión</th>
                                    <th>Inicio de la conexión</th>
                                    <th>Fin de la conexión</th>
                                    <th>Tiempo total de conexión</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AllSessions as $item)
                                    <tr class="text-secondary-emphasis">
                                        <td class="text-center">{{ $item->user_id }}</td>
                                        <td>{{ $item->user_name }}</td>
                                        <td>{{ $item->session_status }}</td>
                                        <td>{{ $item->session_date->format('d/m/Y') }}</td>
                                        <td>{{ $item->session_time_start->format('H:i A') }}</td>
                                        <td>{{ $item->session_time_closing ? $item->session_time_closing->format('H:i A') : 'Por definir' }}
                                        </td>
                                        <td>{{ $item->session_duration ? $item->session_duration->format('H:i:s') : 'Por definir' }}
                                        </td>
                                        <td>
                                            @if ($item->session_time_closing)
                                                <button type="button" class="btn btn-danger" disabled>
                                                    <i class='bx bx-block'></i>
                                                    Cerrar sesión
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger"
                                                    wire:click='closeSessionUser( {{ $item->user_id }} )'>
                                                    <i class='bx bx-block'></i>
                                                    Cerrar sesión
                                                </button>
                                            @endif
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

    {{-- ESTILOS DE LA TABLA --}}
    <style>
        input[id="searchIdUser"]::placeholder {
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
