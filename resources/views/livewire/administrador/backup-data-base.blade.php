<div>
    <section class="container-fluid p-4">

        <div class="border border-2 border-success rounded p-5 mt-3"
            style="box-shadow: 10px 10px 10px rgba(62, 62, 62, 0.5);">

            <form id="formLogin" wire:submit="backup">

                <h3 class="fw-normal text-center text-success mb-4">
                    <b>Ingrese el dato solicitado para realizar la copia de seguridad</b>
                </h3>

                {{-- MENSAJE DE CARGA --}}
                <div class="alert alert-info mb-3 p-2 w-100" wire:loading>
                    <h5><i class="spinner-border" role="status"></i>¡ Procesando !</h5>
                </div>

                @if (session('success'))
                    <x-AlertaMensaje typeAlert="alert-success" mensaje="{{ session('success') }}" />
                @endif

                @if (session('danger'))
                    <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ session('danger') }}" />
                @endif

                {{-- INPUT CONTRASEÑA ADMINISTRADOR --}}
                <div class="form-floating mb-4 rounded border border-2 border-success text-success">
                    <input type="password" class="form-control text-success" id="floatingPassword" wire:model="AdminPassword"
                            placeholder="Password"> 
                    <label for="floatingPassword">Contraseña de administrador</label>
                </div>
                @if ($errors->has('AdminPassword'))
                    <x-AlertaMensaje typeAlert="alert-danger" mensaje="{{ $errors->first('AdminPassword') }}" />
                @endif

                <button class="btn btn-success w-100 py-2" type="submit">Generar copia de seguridad</button>

            </form>
        </div>

    </section>
</div>
