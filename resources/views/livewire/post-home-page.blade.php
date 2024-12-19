<div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        {{-- ITERAMOS LAS NOTICIAS EN CARDS --}}
        @foreach ($Posts as $item)
            <div class="col">
                <div class="card shadow-sm border border-success">
                    <div class="card-header border-bottom border-success">
                        <img class="bd-placeholder-img card-img-top rounded mt-3" width="100%" height="225"
                            src="{{ asset($item->post_img) }}" role="img" aria-label="Placeholder: Thumbnail"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" />
                        <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                            <h5 class="text-success text-center mt-2">{{ $item->post_tittle }}</h5>
                        </text>
                        </img>
                    </div>
                    <div class="card-body cardPost">
                        <div class="card-text d-flex flex-column align-items-center">
                            {!! Str::limit(str_replace(['{', '}', '<em>', '</em>'], '', $item->post_body), 500) !!}
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" wire:click='showPost({{ $item->id_post }})'>
                            Ver más
                        </button>
                        <small class="text-success"><b>{{ $item->post_date->format('d/m/Y') }}</b></small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- PARA VER MAS INFORMACION SOBRE UNA PUBLICACION --}}
    @if ($Modal == true)
        <div class="modal fade show" style="display: block; padding-right: 15px; backdrop-filter: blur(0.4rem);"aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-body border border-2 border-success text-center p-5">
                    <div class="modal-body mb-3" style="max-height: 400px; overflow-y: auto;">
                        <h4 class="text-success">{{ $FindPost->post_tittle }}</h4>
                        {!! $FindPost->post_body !!}
                    </div>
                    <button type="button" class="btn btn-success" wire:click='openAndCloseModal'>
                        Dejar de ver más
                    </button>
                </div>
            </div>
        </div>
    @endif
    
    {{-- ESTILO PARA AJUSTAR EL TAMAÑO DEL CONTENIDO --}}
    <style>
        .cardPost {
            height: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
    </style>

</div>
