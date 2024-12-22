<div>

    <div class="modal fade show d-block formCreateAndEditPost" style="backdrop-filter: blur(0.4rem);">

        <div class="modal-dialog modal-dialog-centered modal-fullscreen">

            <div class="modal-content p-3">
                {{-- FORMUALRIO DE EDICION DE PUBLICACION --}}
                <form action="{{ route('editpost.index', ['id_post'=>$PostEdit->id_post, 'admin'=>$UserAdmin]) }}" method="POST" enctype="multipart/form-data" id="formPost">
                    @csrf
                    @method('PUT')

                    <div class="d-flex align-items-center row border-2 border-bottom border-success" style="padding-bottom: 15px;">
                        <div class="col-lg-4 text-success">
                            <h4>Publicación: <span class="text-warning">{{ $PostEdit->post_code }}</span></h4>
                        </div>
                        {{-- BOTONES DEL FORMULARIO --}}
                        <div class="col-lg-8 btns-form">
                            @if ($UserAdmin === 'true')
                                <a href="{{ route('dashboard', ['vista' => 'allPosts']) }}"
                                    class="btn btn-danger w-25 me-2">Cancelar</a>
                            @else
                                <a href="{{ route('dashboard', ['vista' => 'mePosts']) }}"
                                    class="btn btn-danger w-25 me-2">Cancelar</a>
                            @endif
                            <button type="submit" class="btn btn-success w-25">Guardar</button>
                        </div>
                    </div>

                    <div class="row align-items-center border-bottom border-success py-3">

                        {{-- INPUT IMAGEN --}}
                        <div class="col-lg-4 d-flex justify-content-center contenedor-btn-file my-2">
                            <label class="form-label text-center" for="foto">
                                <h4 class="text-success text-center mb-3"><b>Cambie la imagen:</b></h4>
                                <img src="{{ asset( $PostEdit->post_img ) }}" class="img-fluid border-2 border border-success rounded" id="img"
                                    style="width: 300px; max-height: 300px;">
                                <input type="file" id="foto" name="PostImg" style="width: 30px; height: 30px;">
                            </label>
                        </div>

                        {{-- INPUT DESCRIPCION DEL POST --}}
                        <div class="col-lg-8 text-success text-center">
                            <div class="border border-2 border border-success rounded">
                                <textarea id="editor" name="PostBody">
                                    {!! str_replace(['{', '}', '<em>', '</em>'], '', $PostEdit->post_body) !!}
                                </textarea>
                            </div>
                        </div>

                    </div>

                    {{-- INPUT TITULO --}}
                    <div class="my-3">
                        <h4 class="text-success mb-2"><b>Modifique el título:</b></h4>
                        <input type="text" class="form-control border border-2 border-success text-success" style="width: 85%;"
                            name="PostTittle" value="{{ $PostEdit->post_tittle }}">
                    </div>

                </form>

            </div>

        </div>

    </div>

    <style>
        .btns-form{
            text-align: end;
        }
        @media (max-width: 768px) {
            .btns-form {
                text-align: left;
            }
        }
    </style>

</div>
