<x-LayoutLogins title="Inicia sesión">

    <div class="border border-2 border-success rounded p-4 mt-2"
        style="box-shadow: 10px 10px 10px rgba(62, 62, 62, 0.5);">

        <form action="{{ route('contraseña.nueva', $id_user) }}" method="POST" id="formLogin">
            @csrf
            <div class="container text-center">
                <img class="mb-4 rounded" src="{{ asset('img/logo-megaSoftt-removebg-preview.png') }}" alt=""
                    width="100" height="100">
                <h5 class="text-success text-center mb-3">
                    <b>¡Ingrese el código de recuperación <br>
                        enviado a su correo electrónico!</b>
                </h5>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="text" class="form-control text-success" name="codeConfirm" id="inputCodigo"
                    placeholder="name@example.com">
                <label for="floatingInput">Código de recuperación</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="newPassword" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Nueva contraseña</label>
            </div>

            <div class="form-floating mb-3 rounded border border-2 border-success text-success">
                <input type="password" class="form-control text-success" name="confirmPassword" id="floatingPassword"
                    placeholder="Password">
                <label for="floatingPassword">Confirmar contraseña</label>
            </div>

            <button class="btn btn-success w-100 py-2" type="submit">Cambiar contraseña</button>

        </form>
    </div>

    {{-- PARA INDICAR COMO DEBE SER EL CODIGO EN EL CLIENTE --}}
    <script>
        const input = document.getElementById('inputCodigo');
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
            if (this.value.length >= 8) {
                this.value = this.value.substring(0, 8);
            }
        });
    </script>

</x-LayoutLogins>
