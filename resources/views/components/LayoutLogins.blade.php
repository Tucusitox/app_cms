<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/logo-megaSoftt-removebg-preview.png') }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!-- Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Estilos Extras -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>{{ $tittle ?? 'Laravel' }}</title>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <x-BotonCambioTemas />

    <main class="w-auto m-auto p-3">
        {{ $slot }}
    </main>

    {{-- ALERTAS PARA ERRORES DE VALIDACION --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: "error",
                html: "@foreach ($errors->all() as $error) <h5>{{ $error }}</h5> @endforeach",
                confirmButtonText: "¡Entendido!",
            });
        </script>
    @endif

    @if (session('danger'))
        <script>
            Swal.fire({
                icon: "error",
                title: "<h4>¡{{ session('danger') }}!</h4>",
                confirmButtonText: "¡Entendido!",
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/theme.js') }}"></script>
</body>

</html>
