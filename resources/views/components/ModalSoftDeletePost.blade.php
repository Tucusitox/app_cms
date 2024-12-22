<div class="modal fade show d-block" id="modalPorInactividad" style="backdrop-filter: blur(0.4rem);" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-2 border-danger text-center p-4">
            <i class='bx bx-info-circle text-danger' style="font-size: 100px;"></i>
            <h4 class="text-danger my-4">
                ¿ Seguro que desea eliminar la publicación: 
                <span class="text-warning">{{ $postCode }}</span> ?
            </h4>

            <div class="d-flex justify-content-center align-items-center">
                <button type="button" class="btn btn-danger me-2" wire:click='openAndCloseModal( {{ $idPost }} )'>
                    Cancelar
                </button>
                <form action=" {{ route('deletepost.index', $idPost) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-success">
                        Sí, estoy seguro
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
