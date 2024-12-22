<x-LayoutLogins tittle="Nueva contraseña">

    <div class="border border-2 border-success rounded p-5" style="box-shadow: 10px 10px 10px rgba(62, 62, 62, 0.5);">

        <form action="{{ route('contraseña.store', $id_user) }}" method="POST" id="formLogin">
            @csrf
            <div class="text-center">
                <img class="rounded mb-4" src="{{ asset('img/logo-megaSoftt-removebg-preview.png') }}"
                    width="100" height="100">
                <h1 class="h3 mb-3 fw-normal text-success"><b>Cambie su contraseña para iniciar sesión</b></h1>
            </div>

            @if (session('success'))
                <x-AlertaMensaje mensaje="{{session('success')}}"/>
            @endif

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="BeforePassword" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Contraseña anterior</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="NewPassword" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Nueva contraseña</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="ConfirmPassword" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Confirmar contraseña</label>
            </div>

            <button class="btn btn-success w-100 py-2" type="submit">Cambiar</button>

        </form>
    </div

</x-LayoutLogins>
