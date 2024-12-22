<div class="modal fade show d-block" id="modalPorInactividad" style="backdrop-filter: blur(0.4rem);" aria-modal="true"
    role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-2 border-danger text-center p-4">
            <i class='bx bx-info-circle text-danger' style="font-size: 70px;"></i>
            <h4 class="text-danger my-4">
                ¿ Seguro que desea eliminar de forma permanente al usuario:
                <span class="text-warning">{{ $userName }}</span> ?
            </h4>

            <div class="d-flex flex-column justify-content-center align-items-center w-100">

                <form wire:submit='destroyUser( {{ $idUser }} )'>

                    {{-- MENSAJE DE PROCESANDO --}}
                    <div class="alert alert-warning" wire:loading wire:target='destroyUser'>
                        <h5><i class="spinner-border me-2" role="status"></i>Procesando</h5>
                    </div>
                    
                    {{-- ERRORES DE VALIDACION DE LA CONTRASEÑA --}}
                    @if ($errors->has('AdminPassword'))
                        <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('AdminPassword') }}" />
                    @endif
                    {{-- MENSAJE SI LA contraseña es erronea --}}
                    @if (session('danger'))
                        <x-AlertaMensaje typeAlert="alert-danger" styleText="text-start m-3"
                            mensaje="{{ session('danger') }}" />
                    @endif

                    <div class="form-floating mb-3 rounded border border-2 border-danger text-danger">
                        <input type="password" class="form-control text-danger" wire:model="AdminPassword"
                            id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Contraseña de administrador</label>
                    </div>

                    <button type="button" class="btn btn-danger me-2"
                        wire:click='openAndCloseModal( "eliminar", {{ $idUser }} )'>
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-outline-success">
                        Sí, estoy seguro
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
