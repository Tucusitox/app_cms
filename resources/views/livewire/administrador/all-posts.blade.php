<div>

    <section class="container-fluid p-4">

        <div class="row">
            <div class="col-12">
                <div class="card border border-success">

                    {{-- BUSCADOR POR CODIGO --}}
                    <div class="row card-header d-flex justify-content-between py-4">

                        <div class="col-lg-8 text-success mb-2">
                            <h3>Todas las publicaciones del sistema</h3>
                        </div>
                        <div class="card-tools col-lg-4">
                            {{-- INPUT BUSCAR POR CODIGO --}}
                            <div class="input-group rounded">
                                <input type="search" type="text"
                                    class="form-control border border-success rounded-start text-success"
                                    placeholder="Buscar por código" aria-label="Search" aria-describedby="search-addon"
                                    id="SearchCode" wire:model.live='PostCode' />
                                <span class="input-group-text border-0 bg-success">
                                    <i class='bx bx-search'></i>
                                </span>
                            </div>
                        </div>

                    </div>

                    {{-- ALERTA CUANDO SE ACTULICE UNA PUBLICACION --}}
                    @if (session('success'))
                        <x-AlertaMensaje typeAlert="alert-success" styleText="text-start m-3"
                            mensaje="{{ session('success') }}" />
                    @endif

                    {{-- MENSAJE DE PROCESANDO --}}
                    <div class="alert alert-info m-3" wire:loading wire:target='PostCode'>
                        <h5><i class="spinner-border" role="status"></i>Buscando</h5>
                    </div>

                    {{-- MOSTRAR LAS PUBLICACIONES --}}
                    <div class="card-body table-responsive table-container p-0" style="max-height: 500px;">

                        <table class="table table-head-fixed text-nowrap">

                            @if ($AllPosts->isEmpty())
                                <tr class="text-danger text-center w-100">
                                    <td colspan="5"><b>No se encontraron publicaciones</b></td>
                                </tr>
                            @endif

                            <thead class="bg-body text-success border-top border-bottom border-success">
                                <tr>
                                    <th>Código</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Título</th>
                                    <th>Eliminada lógicamente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($AllPosts as $item)
                                    <tr class="text-secondary-emphasis">
                                        <td>{{ $item->post_code }}</td>
                                        <td>{{ $item->post_date->format('d/m/Y') }}</td>
                                        <td>{{ $item->user_name }}</td>
                                        <td>{{ Str::limit($item->post_tittle, 30)  }}</td>
                                        <td>{{ $item->deleted_at ? 'Si' : 'No' }}</td>
                                        <td>
                                            @if ($item->deleted_at == null)
                                                <a href="{{ route('dashboard', [
                                                    'vista' => 'editPost',
                                                    'id_post' => $item->id_post,
                                                    'admin' => 'true',
                                                ]) }}"
                                                    class="btn btn-info me-2">
                                                    <i class='bx bxs-edit'></i>
                                                    Editar
                                                </a>
                                            @endif

                                            <a class="btn btn-danger"
                                                wire:click='openAndCloseModal( {{ $item->id_post }} )'>
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

    {{-- MODAL PARA ELIMINAR PUBLICACION --}}
    @if ($Modal)
        <x-ModalDeletePost idPost="{{ $PostDelete->id_post }}" postCode="{{ $PostDelete->post_code }}" />
    @endif

    {{-- PARA INDICAR COMO DEBE SER EL CODIGO EN EL CLIENTE --}}
    <script>
        const input = document.getElementById('SearchCode');
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
            if (this.value.length >= 8) {
                this.value = this.value.substring(0, 6);
            }
        });
    </script>

    {{-- ESTILOS DE LA TABLA --}}
    <style>
        input[id="SearchCode"]::placeholder {
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
