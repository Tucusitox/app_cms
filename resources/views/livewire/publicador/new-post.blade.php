<div>
    {{-- FORMULARIO PARA SUBIR NUEVA PUBLICACION --}}
    <section class="container-fluid p-5">
        <div class="card border border-2 border-success rounded p-4">
            {{-- ALERTAS PARA INDICAR REGISTRO EXITOSO --}}
            @if (session('success'))
                <x-AlertaMensaje typeAlert="alert-success" styleText='text-start fs-5'  mensaje="{{ session('success') }}" />
            @endif
            {{-- FORMUALRIO DE CREACION DE PUBLICACION --}}
            <form action="{{ route('newpost.index') }}" method="POST" enctype="multipart/form-data" id="formPost">
                @csrf
                <div class="row align-items-center mb-3">
                {{-- INPUT IMAGEN --}}
                    <div class="col-lg-4 d-flex justify-content-center contenedor-btn-file mt-2">
                        <label class="form-label text-center" for="foto">
                            <h4 class="text-success text-center mb-3"><b>Agregue una imagen:</b></h4>
                            <img src="{{ asset('img/add-img.png') }}" class="img-fluid rounded" id="img"
                                style="width: 500px; max-height: 500px;">
                            <input type="file" id="foto" name="PostImg">
                        </label>
                    </div>

                    {{-- INPUT DESCRIPCION DEL POST --}}
                    <div class="col-lg-8 text-success text-center p-3">
                        <h4 class="mb-3"><b>Contenido de la publicación:</b></h4>
                        <textarea id="editor" name="PostBody"></textarea>
                    </div>

                </div>

                {{-- INPUT TITULO --}}
                <div class="mb-3">
                    <h4 class="text-success mb-2"><b>Título de la publicación:</b></h4>
                    <input type="text" class="form-control border border-2 border-success text-success"
                        name="PostTittle">
                </div>

                <button type="submit" class="btn btn-success w-100">Crear publicación</button>
            </form>
        </div>
    </section>

    {{-- ESTILOS DEL INPUT FILE --}}
    <style>
        #foto {
            display: inline-block;
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 50px;
            top: 0;
            left: 0;
            opacity: 0;
        }

        img {
            cursor: pointer;
        }
    </style>

</div>
