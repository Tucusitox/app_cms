<x-LayoutLogins tittle="Inicia sesión">

    <div class="border border-2 border-success rounded p-5 mt-3"
        style="box-shadow: 10px 10px 10px rgba(62, 62, 62, 0.5);">

        <form action="{{ route('autenticar.index') }}" method="POST" id="formLogin">
            @csrf
            <div class="text-center">
                <img class="rounded mb-4" src="{{ asset('img/logo-megaSoftt-removebg-preview.png') }}" width="100"
                    height="100">
                <h1 class="h3 mb-3 fw-normal text-success"><b>Ingrese los datos solicitados</b></h1>
            </div>

            @if (session('success'))
                <x-AlertaMensaje mensaje="{{ session('success') }}" />
            @endif
            {{-- MENSAJE DE VERIFICACION DE CORREO --}}
            @if ($verifiedEmailSuccess)
                <x-AlertaMensaje mensaje="{{ $verifiedEmailSuccess }}" />
            @endif

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="email" class="form-control text-success" name="email" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Correo electrónico</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="password" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>

            <button class="btn btn-success w-100 py-2" type="submit">Ingresar</button>

        </form>

        <button type="button" class="btn btn-outline-success mt-3 me-2" data-bs-toggle="modal"
            data-bs-target="#FormRecoverPassword">¿Olvido su contraseña?</button>

        <a class="btn btn-success mt-3" href="{{ route('register') }}">Registrate</a>
        
    </div>

    {{-- FORMULARIO PARA INDICAR EL CORREO DEL CODIGO DE CONFIRMACION --}}
    <x-RecoverPassword />

</x-LayoutLogins>
