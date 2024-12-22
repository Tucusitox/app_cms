<x-LayoutLogins tittle="Registro">

    <div class="border border-2 border-success rounded p-5" style="box-shadow: 10px 10px 10px rgba(62, 62, 62, 0.5);">

        <form action="{{ route('registrar.index') }}" method="POST" id="formLogin">
            @csrf
            <div class="text-center">
                <h1 class="h3 mb-3 fw-normal text-success"><b>Registrate en nuestro sistema</b></h1>
            </div>

            @if (session('success'))
                <x-AlertaMensaje mensaje="{{session('success')}}"/>
            @endif

            @if (session('verifiedEmailSuccess'))
                <x-AlertaMensaje typeAlert="alert-success" mensaje="{{session('verifiedEmailSuccess')}}"/>
            @endif

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="text" class="form-control text-success" name="UserName" id="floatingInput"
                    placeholder="Nombre de usuario">
                <label for="floatingInput">Nombre de usuario</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="email" class="form-control text-success" name="UserEmail" id="floatingInput"
                    placeholder="name@example.com">
                <label for="floatingInput">Correo electrónico</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="UserPassword" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Contraseña</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="UserConfirmPassword" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Confirmar contraseña</label>
            </div>

            <button class="btn btn-success w-100 py-2" type="submit">Registrar</button>

        </form>

        <a class="btn btn-outline-success mt-3 me-2" href="{{route('home')}}">Página principal</a>
        <a class="btn btn-warning mt-3" href="{{route('login')}}">Iniciar sesión</a>
    </div>

</x-LayoutLogins>
