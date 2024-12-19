<div>
    <section class="container-fluid p-5">

        <div class="row">
            {{-- CARD CON INFORMACION DEL USUARIO --}}
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body border border-2 border-success rounded text-success text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                            alt="avatar" class="rounded-circle border border-2 border-success img-fluid"
                            style="width: 150px;">
                        <h5 class="my-3"><b>{{ $profileUser->user_name }}</b></h5>
                        <p class="mb-1"><b>{{ $profileUser->email }}</b></p>
                        <p class="mb-4"><b>{{ $profileUser->rol_name }}</b></p>
                        <div class="dropdown-center mb-2">
                            <button class="btn btn-outline-success dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Permisos del usuario
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($permissionsUser as $item)
                                    <li class="dropdown-item">{{ $item->permission_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORMULARIO PARA ACTUALIZAR DATOS --}}
            <div class="col-lg-8">
                <div class="card border border-2 border-success rounded p-4">
                    <form wire:submit='updateDataUser'>
                        <h3 class="text-success text-center mb-3">Actualice su información</h3>

                        <div class="alert alert-success my-2 p-2 w-100" wire:loading>
                            <h5><i class="spinner-border" role="status"></i> ¡Actualizando datos!</h5>
                        </div>

                        @if (session('danger'))
                            <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ session('danger') }}" />
                        @elseif(session('success'))
                            <x-AlertaMensaje typeAlert="alert-success" mensaje="{{ session('success') }}" />
                        @endif

                        <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                            <input type="text" class="form-control text-success" id="floatingInput"
                                placeholder="user example" wire:model='userName'>
                            <label for="floatingInput">{{ $profileUser->user_name }}</label>
                        </div>
                        @if ($errors->has('userName'))
                            <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('userName') }}" />
                        @endif

                        <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                            <input type="text" class="form-control text-success" wire:model='newPassword'
                                id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Nueva contraseña</label>
                        </div>
                        @if ($errors->has('newPassword'))
                            <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('newPassword') }}" />
                        @endif

                        <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                            <input type="text" class="form-control text-success" wire:model='confirmPassword'
                                id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Confirmar contraseña</label>
                        </div>
                        @if ($errors->has('confirmPassword'))
                            <x-AlertaMensaje typeAlert="alert-danger"
                                mensaje="{{ $errors->first('confirmPassword') }}" />
                        @endif

                        <button type="submit" class="btn btn-success w-100">Cambiar contraseña</button>
                    </form>
                </div>
            </div>

            {{-- TABLA CON INFORMACION DE LAS SESIONES --}}
            <div class="container border border-2 border-success rounded text-success p-4 mt-3">
                <h5>Historial de sesiones:</h5>
                <hr class="text-success">
                <div class="table-responsive table-container">
                    <table class="table text-success">
                        <thead class="bg-dark border-bottom border-success">
                            <tr>
                                <th>Fecha</th>
                                <th>Estatus</th>
                                <th>Inicio</th>
                                <th>Cierre</th>
                                <th>Duración</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessionsUser as $item)
                                <tr class="border-bottom border-success">
                                    <td>{{ $item->session_date->format('d/m/Y') }}</td>
                                    <td>{{ $item->session_status }}</td>
                                    <td>{{ $item->session_time_start->format('h:i A') }}</td>
                                    <td>
                                        @if (!$item->session_time_closing)
                                            Por definir
                                        @else
                                            {{ $item->session_time_closing->format('h:i A') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$item->session_duration)
                                            Por definir
                                        @else
                                            {{ $item->session_duration->format('H:m:s') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- ESTILOS DE LA TABLA --}}
    <style>
        .table-container {
            max-height: 300px;
            overflow-y: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;

        }
        th,td {
            padding: 8px;
            text-align: left;
        }
        thead {
            position: sticky;
            top: 0;
            z-index: 1;
        }
        .table-container::-webkit-scrollbar {
            width: 5px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: #28a745;
            border-radius: 5px;
        }
    </style>

</div>
