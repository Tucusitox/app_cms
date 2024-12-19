<x-LayoutDashboard tittle="Dashboard">

    @if ($vista === 'profile')
        @livewire('profile-component')
    @endif

    @if ($vista === 'mePosts')
        @livewire('Publicador.posts-user')
    @endif

    @if ($vista === 'newPost')
        @livewire('Publicador.new-post')
    @endif

    @if ($vista === 'admin')
        <section class="container-fluid py-5 mt-5">
            <div class="card mt-5" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </section>
    @endif

</x-LayoutDashboard>
