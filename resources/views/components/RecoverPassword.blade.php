{{-- FORMULARIO PARA INDICAR EL CORREO DEL CODIGO DE CONFIRMACION --}}
<div class="modal fade" id="FormRecoverPassword">
    <div class="modal-dialog modal-dialog-centered p-2">
        <div class="modal-content border border-2 border-success rounded">

            <form action="{{route('recuperar.store')}}" method="POST">
                @csrf

                <div class="modal-header text-center text-success">
                    <h1 class="modal-title fs-5">Ingrese un correo valido para enviar el código de recuperación</h1>
                </div>
                <div class="modal-body border-2 border-top border-bottom border-success">
                    <div class="form-floating mb-3 rounded border border-2 border-success text-success mt-2">
                        <input type="email" class="form-control text-success" name="email" id="floatingInput"
                            placeholder="name@example.com">
                        <label for="floatingInput">Correo Electrónico</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
                
            </form>

        </div>
    </div>
</div>
