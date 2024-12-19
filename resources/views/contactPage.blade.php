<x-LayoutHomePage tittle='Mega Soft contáctanos'>

    {{-- CONTACTANOS --}}
    <section class="container py-5 mt-5" id="contactanos">
        <div class="container text-success">
            <h3 class="mb-3">Complete los datos para contactarnos</h3>

            {{-- MENSAJE DE ENVIO EXITOSO --}}
            @if (session('success'))
                <x-AlertaMensaje typeAlert="alert-success" styleText="text-start" mensaje="{{session('success')}}"/>
            @endif

            {{-- FORMULARIO DE CONTACTO --}}
            <form action="{{route('contact.send')}}" method="POST">
                @csrf
                <div class="form-floating border border-success rounded mb-3">
                    <input type="text" class="form-control text-success" name="ContactName"
                     id="floatingPassword" placeholder="Nombre">
                    <label for="floatingPassword">Nombre</label>
                </div>
                <div class="form-floating border border-success rounded mb-3">
                    <input type="ContactEmail" class="form-control text-success" name="ContacEmail"
                    id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Correo Electrónico</label>
                </div>
                <div class="form-floating border border-success rounded mb-3">
                    <textarea class="form-control text-success" placeholder="Leave a comment here" name="ContactMensaje"
                    id="floatingTextarea2" style="height: 200px"></textarea>
                    <label for="floatingTextarea2">Mensaje</label>
                </div>

                <button type="submit" class="btn btn-success w-100">Enviar</button>
            </form>
        </div>
    </section>

</x-LayoutHomePage>
