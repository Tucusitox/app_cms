<x-LayoutHomePage tittle='Mega Soft'>

    {{-- NOSOTROS --}}
    <section class="py-5 mt-5" id="nosotros">

        <div class="row py-lg-5 w-100">

            <div class="col-lg-4 container mx-5 img-home">
                <img src="{{ asset('img/imagenFondoHome.jpg') }}"
                    class="img-fluid border border-2 border-success rounded">
            </div>

            <div class="col-lg-6 col-md-6 mx-auto p-3 text-center">
                <h1><b class="fw-light text-success">Mega Soft</b> <b class="fw-light text-primary">Computación</b></h1>
                <p class="lead text-secondary-emphasis">
                    Somos una empresa con más de 30 años en el mercado dedicada
                    a la solución integral de las necesidades en el área de
                    Tecnología de Información.
                </p>
                <div class="container">
                    <a class="btn btn-outline-success mx-2" href="{{ route('noticias') }}">Noticias</a>
                    <a class="btn btn-outline-primary" href="{{ route('contactanos') }}">Contáctanos</a>
                </div>
            </div>
        </div>

    </section>

    <style>
        @media (max-width: 768px) {
            .img-home {
                margin-left: 10px !important;
                margin-right: 0 !important;
            }
        }
    </style>

</x-LayoutHomePage>
